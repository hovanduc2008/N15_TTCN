<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\AuthorEloquentRepository;

class SearchController extends Controller
{

    protected $productRepository;
    protected $categoryRepository;
    protected $authorRepository;

    public function __construct(
        ProductEloquentRepository $productRepository,
        CategoryEloquentRepository $categoryRepository,
        AuthorEloquentRepository $authorRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    public function index(Request $request) {
        $products = $this -> productRepository -> all();
        if($request -> type =='sell') {
            $products  = $this -> productRepository -> paginateWhereOrderBy(['type' => '0'], 'updated_at','DESC', $request -> page ?? 1, 10, ['*']);
        }else if($request -> type =='borrow') {
            $products  = $this -> productRepository -> paginateWhereOrderBy(['type' => '1'], 'updated_at','DESC', $request -> page ?? 1, 10, ['*']);
        }else {
            $products  = $this -> productRepository -> paginateWhereOrderBy([], 'updated_at','DESC', $request -> page ?? 1, 10, ['*']);
        }

        $categories = $this -> categoryRepository -> all();
        $authors = $this -> authorRepository -> all();
        
        return view('user.search', compact('products', 'categories', 'authors'));
    }
}
