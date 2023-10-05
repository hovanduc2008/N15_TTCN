<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\SampleChart;

use App\Models\User;

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
        $orders  = $this -> orderRepository -> paginateWhereOrderBy([], 'updated_at','DESC', 1, 3, ['*']);
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

    // Thống kê
    public function statistics(Request $request) {
        $countCustomer = $this -> customerRepository -> countWhere(['is_admin' => '0'], ['id']);
        $countOrder = $this -> orderRepository -> countWhere([], ['id']);
        $countBorrow = $this -> borrowRepository -> countWhere([], ['id']);
        $topProducts = $this -> productRepository -> topProducts();
        $topCustomerBorrows = $this -> customerRepository -> topCustomerBorrows();
        $topLateReturners = $this -> customerRepository -> topLateReturners();


        // Khởi tạo biểu đồ
        $chartCustomer = new SampleChart;

        // Tạo mảng chứa tên khách hàng
        $customerNames = $topCustomerBorrows->pluck('name')->toArray();

        // Tạo mảng chứa số lượt mượn của khách hàng
        $borrowCounts = $topCustomerBorrows->pluck('borrow_count')->toArray();

        // Đặt nhãn trục x cho biểu đồ là tên khách hàng
        $chartCustomer->labels($customerNames);

        // Thêm dataset cho từng khách hàng
        $chartCustomer->dataset('Lượt mượn', 'bar', $borrowCounts);


        // Khởi tạo biểu đồ
        $chartCustomerLate = new SampleChart;

        // Tạo mảng chứa tên khách hàng
        $customerNames = $topLateReturners->pluck('name')->toArray();

        // Tạo mảng chứa số lượt mượn của khách hàng
        $borrowCounts = $topLateReturners->pluck('late_count')->toArray();

        // Đặt nhãn trục x cho biểu đồ là tên khách hàng
        $chartCustomerLate->labels($customerNames);

        // Thêm dataset cho từng khách hàng
        $chartCustomerLate->dataset('Lần muộn', 'bar', $borrowCounts);

        
        // Khởi tạo biểu đồ
        $chartProduct = new SampleChart;

        // Tạo mảng chứa tên khách hàng
        $customerNames = $topProducts->pluck('title')->toArray();

        // Tạo mảng chứa số lượt mượn của khách hàng
        $borrowCounts = $topProducts->pluck('borrow_count')->toArray();

        // Đặt nhãn trục x cho biểu đồ là tên khách hàng
        $chartProduct->labels($customerNames);

        // Thêm dataset cho từng khách hàng
        $chartProduct->dataset('Lượt mượn', 'bar', $borrowCounts);

        return view('admin.orders.statistics', 
        compact('countCustomer', 
        'countOrder', 'chartCustomer', 'chartProduct', 'chartCustomerLate',
        'countBorrow',
        ));
    }

}
