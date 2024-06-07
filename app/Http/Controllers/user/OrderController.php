<?php

namespace App\Http\Controllers\user;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pdf;
use App\Controllers\VNPayController;

use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\OrderEloquentRepository;
use App\Repositories\Eloquent\OrderDetailEloquentRepository;
use Mail;
use App\Mail\OrderNotiMail;

use App\Models\Product;

class OrderController extends Controller
{

    protected $authorRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(
        AuthorEloquentRepository $authorRepository,
        ProductEloquentRepository $productRepository,
        OrderEloquentRepository $orderRepository,
        OrderDetailEloquentRepository $orderDetailRepository) {
        $this -> authorRepository = $authorRepository;
        $this -> productRepository = $productRepository;
        $this -> orderRepository = $orderRepository;
        $this -> orderDetailRepository = $orderDetailRepository;
    }

    public function index () {
        $orders = $this -> orderRepository -> findWhere(['user_id' => auth() -> guard('web') -> user() -> id]);
        
        return view('user.order', compact('orders'));
    }

    public function orderDetail(Request $request) {
        $id = $request -> id;
        $orderInfo = $this -> orderRepository->findById($id);
        $products = $this -> orderDetailRepository -> findWhere(['order_id' => $id]);
        return view('user.order-detail', compact('orderInfo', 'products'));
    }

    public function createOrder(Request $request) {
        if(!auth() -> guard('web') -> check()) return redirect() -> back();
        $cart = session() -> get('cart');
        $productsInCart = [];
        $totalPrice = 0;
        $order_title = '';
        foreach ($cart as $item) {
           
            if($item['checked'] == 1) {
                $product = $this -> productRepository -> findById($item['productid']);
                if ($product) {
                    $totalPrice += ($product['price'] * $item['quantity']);
                    $product->quantityInCart = $item['quantity'];
                    $productsInCart[] = $product;
                    $order_title .= $product -> title.', ';
                }
            }
        } 

        $count = count($productsInCart);

        //if(count($cart) <= 0) return redirect() -> route('cart');
        
        return view('user.order-confirm',  compact('productsInCart', 'count', 'totalPrice'));
    }

    public function orderNow(Request $request) {
        $productId = $request -> productId;
        $product = Product::findOrFail($productId);
        
        if (!$request->session()->has('cart')) {
            $cart = [];
        } else {
            $cart = $request->session()->get('cart');
        }

        $existingProduct = null;
        foreach ($cart as $key => $item) {
            $item['checked'] = 0;
            if ($item['productid'] == $productId) {
                $existingProduct = $key;
                break;
            }
        }
        
        if ($existingProduct !== null) {
            unset($cart[$existingProduct]);
            
        } else {
            $cart[] = [
                'productid' => $productId,
                'cart_quantity' => $request->cart_quantity,
                'quantity' => $request->cart_quantity,
                'checked' => 1
            ];
        }

        $request->session()->put('cart', $cart);

        $cart = $request->session()->get('cart');

        

        foreach ($cart as &$item) {
            if (!($item['productid'] == $productId)) {
                $item['checked'] = 0;
            }
        }

        $request->session()->put('cart', $cart);
       
        return redirect() -> route('createOrder');
    }

    public function submitOrder(Request $request) {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $cart = session() -> get('cart');
        
        $productsInCart = [];
        $totalPrice = 0;
        $order_title = "";
        foreach ($cart as $item) {
            if($item['checked'] == 1) {
                $product = $this -> productRepository -> findById($item['productid']);
                if ($product) {
                    $totalPrice += ($product['price'] * $item['quantity']);
                    $product->quantityInCart = $item['quantity'] ?? 1;
                    $productsInCart[] = $product;

                    $order_title .= $product -> title." [x".$product->quantityInCart."]  ";
                }
            }
        }

        $request -> merge([
            'user_id' => auth() -> guard('web') -> user() -> id,
            'total_amount' => $totalPrice,
            'order_note' => $request -> note ?? '',
            'payment_method' => $request -> pay_method,
            'order_code' => '',
            'order_title' => $order_title
        ]);

        //dd($request -> all());

        $order = $this -> orderRepository -> create($request -> all());
        $orderId = $order->id;
        $totalPrice = 0;

        foreach($productsInCart as $product) {
            $totalPrice += $product->price * $product -> quantityInCart;
            DB::table('order_details') -> insert([
                'addby_id' => auth() -> guard('web') -> user() -> id,
                'product_id' => $product -> id,
                'order_id' => $orderId,
                'quantity' => $product -> quantityInCart,
                'item_price' => $product -> price
            ]);
        }

        foreach ($cart as $key => $item) {
            if ($item['checked'] == 1) {
                session()->forget("cart.$key");
            }
        }

        $user = auth() -> guard('web') -> user();

        $order = $this -> orderRepository -> findById($orderId);
        $order_details = $this -> orderDetailRepository -> findWhere(['order_id' => $orderId]);
        Mail::to(auth() -> guard('web') -> user() -> email)->send(new OrderNotiMail($user,$order_details,$totalPrice, $order));
        
        if($request -> pay_method == '2') 
            return redirect() -> route('createpayment')
            -> with('amount', $totalPrice)
            ->with('orderId', $orderId);
        
        return redirect() -> route('orderDetail', ['id' => $orderId]);
    }

    public function orderInvoiceView (Request $request) {
        $orderId = $request->id;
        $order = $this -> orderRepository -> findById($orderId);
        $order_details = $this -> orderDetailRepository -> findWhere(['order_id' => $orderId]);
        return view('user.order-invoice', compact('order', 'order_details'));
    }
    public function orderInvoiceGenerate (Request $request) {
        $orderId = $request->id;
        $order = $this -> orderRepository -> findById($orderId);
        $order_details = $this -> orderDetailRepository -> findWhere(['order_id' => $orderId]);
        $print = 1;
        return view('user.order-invoice', compact('print', 'order', 'order_details'));
    }
}


