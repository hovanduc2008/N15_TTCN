<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;
use Validator;

use App\Http\Controllers\ImageController;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $authorRepository;

    public function __construct(
        ProductEloquentRepository $productRepository,
        CategoryEloquentRepository $categoryRepository,
        AuthorEloquentRepository $authorRepository) {
        
        $this -> productRepository = $productRepository;
        $this -> categoryRepository = $categoryRepository;
        $this -> authorRepository = $authorRepository;
    }

    public function index(Request $request) {    
        
        if(count($request -> all()) > 0) {
            $products = $this -> filterProducts($request);
        }else {
            $products = $this -> productRepository -> findWhere(["type" => "0"]); 
        }
        $old_filters = $request -> all();
        return view('admin.products.index', compact('products', 'old_filters'));
    }

    public function createForm() {
        $categories = $this -> categoryRepository -> all();
        $authors = $this -> authorRepository -> all();

        return view('admin.products.create', compact('categories', 'authors'));
    }

    public function handleCreate(Request $request,ImageController $img) {
        $validated = $request -> validate([
            'title' => 'required',
            'price' => 'required|integer',
        ]);

        $request -> merge($img -> upload($request));

        $data = $request -> merge(
            [
                'added_by' => auth('web') -> id(),
                'slug' => Str::slug($request -> title),
                'category_id' => $request -> category,
                'author_id' => $request -> author
            ]
        ) -> all();

       

        $this -> productRepository -> create($data);

        return redirect() -> route('admin.products') -> with('success', 'Tạo thành công sách');
    }

    public function editForm(Request $request) {
        $categories = $this -> categoryRepository -> all();
        $authors = $this -> authorRepository -> all();
        $foundProduct = $this -> productRepository -> findById($request -> id);

        return view('admin.products.edit', compact('categories', 'authors', 'foundProduct'));
    }

    public function handleEdit(Request $request, ImageController $img) {
        
        $validated = $request -> validate([
            'title' => 'required',
            'price' => 'required|integer'
        ]);

        $foundProduct = $this -> productRepository -> findById($request -> id);

        $request -> merge([
            'author_id' => $request -> author,
            'category_id' => $request -> category,
        ]);

        // if(isset($request -> is_active)) {  
        //     $request -> merge([
        //         'status' => 1
        //     ]); 
        // }else {
        //     $request -> merge([
        //         'status' => 0
        //     ]);
        // }

        $hasFileImage = $request -> hasFile('upload_image');
        $hasFileThumbnail = $request -> hasFile('upload_thumbnail');

        if($hasFileImage || isset($request -> is_delete)) {
            $img -> remove($foundProduct -> image);
        }
        if($hasFileThumbnail) {
            $img -> remove($foundProduct -> thumbnail);   
        }
        $request -> merge($img -> upload($request));

        if(isset($request -> is_delete)) {
            $request -> merge([
                'image' => '',
            ]);
        }

        $this -> productRepository ->update($request -> all(), $foundProduct -> id);

        return redirect() -> route('admin.product.edit', $foundProduct -> id) -> with('success', 'Updated product');
    }

    public function handleDelete(Request $request, ImageController $img) {
        $id = $request -> id;
        $foundProduct = $this -> productRepository -> findById($id);
        $img -> remove($foundProduct -> image);

        $this -> productRepository -> delete($id);
        
        return redirect() -> route('admin.products') -> with('success', 'Xóa thành công product');
    }

    public function borrowProducts() {
        $products = $this -> productRepository -> findWhere(['type'=> '1']);
        return view('admin.products.borrowproducts', compact('products'));
    }

    public function filterProducts(Request $request) {
        $price_start = $request -> price_start;
        $price_end = $request -> price_end;

        if(isset($price_start) && isset($price_end)){
            $price_range = [
                $price_start."-".$price_end
            ];
        }else {
            $price_range = '';
        }
        
        
        $products = $this -> productRepository -> filterProducts(
            $price_range,
            $request -> sort_filter,
            $request -> status_filter,
            $request -> keyword,
        );
        return $products;
    }

}
