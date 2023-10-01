<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\BorrowEloquentRepository;
use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class BorrowController extends Controller
{
    protected $borrowRepository;
    protected $customerRepository;
    protected $productRepository;

    public function __construct(
        BorrowEloquentRepository $borrowRepository,
        CustomerEloquentRepository $customerRepository,
        ProductEloquentRepository $productRepository
        ) {
        $this -> borrowRepository = $borrowRepository;
        $this -> customerRepository = $customerRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        
        $borrows = $this -> borrowRepository -> all();
        
        return view('admin.borrows.index', compact('borrows'));
    }

    public function filterByUser(Request $request) {
        $user_id = $request -> route('user_id');
        $type = $request -> route('type');
        $foundUser = $this -> customerRepository -> findById($user_id);
        if($type == 'borrowing') {
            $borrows = $foundUser -> borrowing;
        }else if($type == 'borrowed') {
            $borrows = $foundUser -> borrowed;
        }else {
            $borrows = $foundUser -> borrows;
        }
        return view('admin.borrows.index', compact('borrows'));
    }

    public function createForm(Request $request) {
        if($request -> user_id) {
            $customers = [$this -> customerRepository -> findById($request -> user_id)];
        }else{
            $customers = $this -> customerRepository -> allCustomer();
        }
        
        if($request -> product_id) {
            $products = [$this -> productRepository -> findById($request -> product_id)];
        }else {
            $products = $this -> productRepository -> findWhere([
                'status' => '1',
                'type' => '1',
                ['quantity', '>', '0']
            ]);
        }
        
        return view('admin.borrows.create', compact('customers', 'products'));
    }

    public function handleCreate(Request $request) {
        $validated = $request -> validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'borrow_date' => 'required',
            'return_date' => 'required'
        ]);

        $foundProduct = $this-> productRepository->findById($request -> product_id);
        $foundUser = $this -> customerRepository -> findById($request -> user_id);

        
        if($foundProduct -> quantity <= 0) {
            return redirect() -> route('admin.borrow.create') -> with(['error' => "Sách không có sẵn!"]);
        }

        $this -> borrowRepository -> create($request -> all());

        return redirect() -> route('admin.borrows') -> with(['success' => "Tạo thành công đơn mượn sách!"]);
        
    }

    public function filterByProduct(Request $request) {
        $product_id = $request -> route('product_id');
        
        $foundProduct = $this -> productRespository -> findById($product_id);
        $borrows = $foundProduct -> borrowing;
        return view('admin.borrows.index', compact('borrows'));
    }
}
