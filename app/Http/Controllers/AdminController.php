<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Get the admin home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'orders' => Order::get(),
        ];
        return view('admin.index', $data);
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
        try {
            $this->processingOrders($selectedOrders);
        } catch (QueryException $ex) {
            $request->session()->flash('error', __('orders.processed_error') . $ex->getMessage());
        }
        return view('admin.index', ['orders' => Order::get()]);
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
}
