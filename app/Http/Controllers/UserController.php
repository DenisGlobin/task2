<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderAdded;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Get the application home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lastUserOrder = $this->getLastUserOrder();
        if (isset($lastUserOrder) && $this->isEnoughElapsedTime($lastUserOrder)) {
            $nextOrderAt = Carbon::createFromFormat('Y-m-d H:i:s', $lastUserOrder->created_at)->addDay();
            return view('user.wait', ['nextOrderAt' => $nextOrderAt]);
        }
        return view('user.index', ['userId' => Auth::id()]);
    }

    /**
     * Add the new order
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addOrder(OrderRequest $request)
    {
        $orderData = $request->all();
        //Call uploadFile method if the request have upload file
        if ($request->hasFile('file')) {
            $orderData['file'] = $this->uploadFile($request);
        } else {
            $orderData['file'] = null;
        }
        //Record order's info to Database
        try {
            $order = $this->saveOrderInfo($orderData);
        } catch (QueryException $ex) {
            $request->session()->flash('error', __('orders.create_error') . $ex->getMessage());
            return view('user.index', ['userId' => Auth::id()]);
        }
        //Notify admin about the new order
        try {
            $admin = User::where('is_admin', 1)->firstOrFail();
            Mail::to($admin)->queue(new OrderAdded($order));
        } catch (ModelNotFoundException $ex) {
            $request->session()->flash('error', __('orders.email_admin') . $ex->getMessage());
            return view('user.index', ['userId' => Auth::id()]);
        } catch (\Exception $ex) {
            $request->session()->flash('error', __('orders.email_send') . $ex->getMessage());
            return view('user.index', ['userId' => Auth::id()]);
        }
        //Show how long to wait for add a new order
        $request->session()->flash('success', __('orders.create_success'));
        $nextOrderAt = now()->addDay();
        return view('user.wait', ['nextOrderAt' => $nextOrderAt]);
    }

    /**
     * Save order's info to Database using the Eloquent model
     *
     * @param array $data
     * @return mixed
     */
    private function saveOrderInfo(array $data)
    {
        return Order::create([
            'user_id' => $data['userId'],
            'title' => $data['title'],
            'message' => $data['message'],
            'file_path' => $data['file'],
        ]);
    }

    /**
     * Uploading file on the server
     *
     * @param Request $request
     * @return string
     */
    private function uploadFile(OrderRequest $request)
    {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs(
            'public/attach', $fileName
        );
        return asset('storage/attach/' . $fileName);
    }

    /**
     * Find the last order added by user in Database
     *
     * @return mixed
     */
    private function getLastUserOrder()
    {
        return Order::where('user_id', Auth::id())->latest()->first();
    }

    /**
     * Check if enough time has passed to add a new order
     *
     * @param Order $lastUserOrder
     * @return bool
     */
    private function isEnoughElapsedTime(Order $lastUserOrder)
    {
        if (now()->subDay()->lt($lastUserOrder->created_at)) {
            return true;
        }
        return false;
    }
}
