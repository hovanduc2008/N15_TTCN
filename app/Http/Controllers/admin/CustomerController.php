<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\CustomerEloquentRepository;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerEloquentRepository $customerRepository) {
        $this -> customerRepository = $customerRepository;
    }

    public function index() {
        $customers = $this -> customerRepository -> allCustomer();
        
        return view('admin.customers.index', compact('customers'));
    }
}
