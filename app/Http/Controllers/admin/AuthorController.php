<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\ImageController;
use App\Repositories\Eloquent\AuthorEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;

class AuthorController extends Controller
{

    protected $authorRepository;
    protected $productRepository;

    public function __construct(
        AuthorEloquentRepository $authorRepository,
        ProductEloquentRepository $productRepository) {
        $this -> authorRepository = $authorRepository;
        $this -> productRepository = $productRepository;
    }

    public function index(Request $request) {
        if(count($request -> all()) > 0) {
            $authors = $this -> filterAuthors($request);
        }else {
            $authors = $this -> authorRepository -> all(); 
        }
        $old_filters = $request -> all();
        return view('admin.authors.index', compact('authors', 'old_filters'));
    }

    public function createForm() {
        return view('admin.authors.create');
    }

    public function handleCreate(Request $request, ImageController $img) {
        $validator = $request ->  validate([
            'name' => 'required'
        ]);

        if ($request -> hasFile('upload')) {
            $request -> merge([
                'image' => $img -> upload($request)
            ]); 
        }

        $data = [
            'added_by' => auth('web') -> id(),
            'name' => $request -> name,
            'biography' => $request -> biography,
            'image' => $request -> image ?? ''
        ];

        $this -> authorRepository -> create($data);

        return redirect() -> route('admin.authors') -> with('success', 'Tạo thành công tác giả');

    }

    public function editForm(Request $request) {
        $foundAuthor = $this -> authorRepository -> findById($request-> id);
        return view('admin.authors.edit', compact('foundAuthor'));
    }

    public function handleEdit(Request $request, ImageController $img) {
        $validator = $request -> validate([
            'name' => 'required',
        ]);
        $foundAuthor = $this -> authorRepository -> findById($request -> id);

        if(isset($request -> is_delete)) {
            $img -> remove($foundAuthor -> image);
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
            $img -> remove($foundAuthor -> image);
            $request -> merge([
                'image' => $img -> upload($request)
            ]);
        }

        

        $this -> authorRepository -> update($request -> all(), $foundAuthor -> id);

        return redirect() -> route('admin.authors') -> with('success', 'Updated author');

    }

    public function handleDelete(Request $request, ImageController $img) {
        $id = $request -> id;
        $foundAuthor = $this -> authorRepository -> findById($id);
        $img -> remove($foundAuthor -> image);
        $productsDp = $this -> productRepository -> findWhere(['author_id' => $id], array('*'));
        foreach($productsDp as $product) {
            $img -> remove($product -> image);
        }
        $this -> productRepository -> deleteWhere(['author_id' => $id]);
        $this -> authorRepository -> delete($id);
        
        return redirect() -> route('admin.authors') -> with('success', 'Xóa thành công tác giả');
    }

    public function filterAuthors(Request $request) {
        $categories = $this -> authorRepository -> filterAuthors(
            $request -> sort_filter,
            $request -> status_filter,
            $request -> keyword,
        );
        return $categories;
    }
}
