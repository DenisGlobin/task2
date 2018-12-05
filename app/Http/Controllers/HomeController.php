<?php

namespace App\Http\Controllers;

use App\Mail\OrderAdded;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the application home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            return $this->getAdminPage();
        }
        return $this->getUserPage();
    }

    /**
     * Add the new order
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addOrder(Request $request)
    {
        $orderData = $request->all();
        //Call uploadFile method if the request have upload file
        if ($request->hasFile('file')) {
            $orderData['file'] = $this->uploadFile($request);
        } else {
            $orderData['file'] = null;
        }
        //Record order's info to Database
        $order = $this->saveOrderInfo($orderData);
        if (!($order instanceof Order)) {
            $request->session()->flash('error', 'Ошибка! Не получилось создать заказ');
            return back();
        }

        $admin = User::where('is_admin', 1)->take(1)->get();
        Mail::to($admin)->send(new OrderAdded($order));

        $request->session()->flash('success', 'Ваш заказ сохранён');
        return $this->getUserPage();
    }

    /**
     * Processing selected orders
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processedOrders(Request $request)
    {
        $selectedOrders = $request->input('chkbox');
        $this->processingOrders($selectedOrders);
        return $this->getAdminPage();
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
    private function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        /*$path = Storage::putFileAs(
            'public/attach', $file, $fileName
        );*/
        $path = $file->storeAs(
            'public/attach', $fileName
        );
        return asset('storage/attach/' . $fileName);
    }

    /**
     * Set property is_processed of the selected orders in Database as true
     *
     * @param array $chkboxes
     */
    private function processingOrders(array $chkboxes)
    {
        foreach ($chkboxes as $chkbox) {
            $order = Order::findOrFail($chkbox);
            $order->is_processed = 1;
            $order->save();
        }
    }

    /**
     * Show user home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function getUserPage()
    {
        return view('user.index', ['userId' => Auth::id()]);
    }

    /**
     * Show admin home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function getAdminPage()
    {
        $data = [
            'orders' => Order::get(),
        ];
        return view('admin.index', $data);
    }
}
