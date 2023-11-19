<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;

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

    public function index (Request $request) {
        $slug = $request->slug;
        if($slug) $foundProduct = $this -> productRepository -> findBySlug($slug);
        return view('user.product-detail', compact('foundProduct'));
    }

    public function readbook(Request $request) {
        return 1;
    }
}
