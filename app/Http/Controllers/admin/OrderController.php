<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\OrderEloquentRepository;
use App\Repositories\Eloquent\OrderDetailEloquentRepository;
use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Repositories\Eloquent\BorrowEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

use App\Models\OrderDetail;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $customerRepository;
    protected $borrowRepository;

    public function __construct(
        OrderEloquentRepository $orderRepository,
        OrderDetailEloquentRepository $orderDetailRepository,
        CustomerEloquentRepository $customerRepository,
        BorrowEloquentRepository $borrowRepository,
        ProductEloquentRepository $productRepository
        ) {
        $this -> orderRepository = $orderRepository;
        $this -> orderDetailRepository = $orderDetailRepository;
        $this -> customerRepository = $customerRepository;
        $this -> borrowRepository = $borrowRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        if(count($request -> all()) > 0){
            $orders = $this -> filterOrders($request);
        }else {
            $orders = $this -> orderRepository -> all();
        }
        $old_filters = $request -> all();
        return view('admin.orders.index', compact('orders', 'old_filters'));
    }

    public function detail(Request $request) {
        $foundOrder = $this -> orderRepository -> findById($request -> id);
        $products = $this -> orderDetailRepository -> joinFindId('order_id', '=', $foundOrder -> id, 'products', 'product_id', [
            'title',
            
        ]);
        
        return view('admin.orders.detail', compact('foundOrder', 'products'));
    }

    public function changeStatus(Request $request) {
        $foundOrder = $this -> orderRepository -> findById($request -> id);
        $update = $this -> orderRepository -> update([
            'order_status' => $request -> status
        ], $foundOrder -> id);
        return redirect() -> route('admin.orders.detail', $foundOrder -> id) -> with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }

    public function filterOrders(Request $request) {
        $orders = $this -> orderRepository -> filterOrders(
            $request -> sort_filter,
            $request -> status_filter,
            $request -> id,
        );
        return $orders;
    }

    public function statistics(Request $request) {
        $countCustomer = $this -> customerRepository -> countWhere(['is_admin' => '0'], ['id']);
        $countOrder = $this -> orderRepository -> countWhere([], ['id']);
        $countBorrow = $this -> borrowRepository -> countWhere([], ['id']);
        $topProducts = $this -> productRepository -> topProducts();
        $topCustomerBorrows = $this -> customerRepository -> topCustomerBorrows();
        
        $topLateReturners = $this -> customerRepository -> topLateReturners();
        
        return view('admin.orders.statistics', 
        compact('countCustomer', 
        'countOrder', 
        'countBorrow', 
        'topProducts',
        'topCustomerBorrows', 
        'topLateReturners'));
    }

}
