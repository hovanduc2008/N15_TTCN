<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Product;

class ProductEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Product::class;
    }

    public function filterProducts($price_filter, $sort_filter, $status, $keyword) {
        $query = $this->model->select('products.*');
    
        if ($status == 0 || $status == 1) {
            $query = $query->where('products.status', $status);
        }
    
        if ($keyword) {
            $query = $query->where("title","like", "%$keyword%");
        }
        if ($price_filter && is_array($price_filter)) {
            
            $query = $query->where(function ($q) use ($price_filter) {
                foreach ($price_filter as $price_range) {
                    $price_arr = explode('-', $price_range);
                    $start_price = $price_arr[0];
                    $end_price = $price_arr[1];
                    $q->orWhereBetween('products.price', [$start_price, $end_price]);
                }
            });
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('products.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('products.created_at', 'asc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('products.price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('products.price', 'desc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('products.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('products.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        return $query->get();
    }
}