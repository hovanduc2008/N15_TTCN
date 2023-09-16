<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ImageController;

use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(
        CategoryEloquentRepository $categoryRepository,
        ProductEloquentRepository $productRepository
    ) {
        $this -> categoryRepository = $categoryRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        if(count($request -> all()) > 0) {
            $categories = $this -> filterCategories($request);
        }else {
            $categories = $this -> categoryRepository -> all(); 
        }  
        $old_filters = $request -> all();
        return view('admin.categories.index', compact('categories', 'old_filters'));
    }

    public function createForm() {
        return view('admin.categories.create');
    }

    public function handleCreate(Request $request, ImageController $img) {

        // $validated = $request -> validate([
        //     'slug' => 'required|unique:categories',
        // ]);

        if($request -> hasFile('upload')) {
            $request -> merge([
                'image' => $img -> upload($request)
            ]);  
        }

        $data = [
            'added_by' => auth('web') -> id(),
            'title' => $request -> title,
            'slug' => $request -> title,
            'image' => $request -> image ?? ''
        ];

        $this -> categoryRepository -> create($data);

        $title = $request -> title;

        return redirect() -> route('admin.categories') -> with(['success' => "Thêm thành công danh mục: $title!"]);
    }

    public function editForm(Request $request) {
        $foundCategory = $this -> categoryRepository -> findById($request -> id);
        return view('admin.categories.edit', compact('foundCategory'));
    }

    public function handleEdit(Request $request, ImageController $img) {
        $validator = $request -> validate([
            'title' => 'required',
        ]);

        $foundCategory = $this -> categoryRepository -> findById($request -> id);

        if(isset($request -> is_delete)) {
            $img -> remove($foundCategory -> image);
            $request -> merge([
                'image' => ''
            ]);
        }

        

        if(isset($request -> is_active)) {  
            $request -> merge([
                'status' => 1
            ]);
            
        }else {
            $request -> merge([
                'status' => 0
            ]);
        }

        if($request -> hasFile('upload')) {
            $img -> remove($foundCategory -> image);
            $request -> merge([
                'image' => $img -> upload($request)
            ]);
        }

        $this -> categoryRepository -> update($request -> all(), $foundCategory -> id);

        return redirect() -> route('admin.categories') -> with('success', 'Updated Category');
    }

    public function handleDelete(Request $request, ImageController $img) {
        $id = $request -> id;
        $foundCategory = $this -> categoryRepository -> findById($id);
        $img -> remove($foundCategory -> image);
        $productsDp = $this -> productRepository -> findWhere(['author_id' => $id], array('*'));
        foreach($productsDp as $product) {
            $img -> remove($product -> image);
        }
        $this -> productRepository -> deleteWhere(['category_id' => $id]);
        $this -> categoryRepository -> delete($id);
        
        return redirect() -> route('admin.categories') -> with('success', 'Xóa thành công danh mục '.$foundCategory -> title);
    }

    public function filterCategories(Request $request) {
        $categories = $this -> categoryRepository -> filterCategories(
            $request -> sort_filter,
            $request -> status_filter,
            $request -> keyword,
        );
        return $categories;
    }
}
