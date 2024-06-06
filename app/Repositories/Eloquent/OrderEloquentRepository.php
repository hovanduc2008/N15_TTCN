<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Order;

class OrderEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Order::class;
    }

    public function filterOrders($limit ,$sort_filter, $search) {
        $query = $this->model->select('orders.*');
        if($search) {
            if(strpos($search, '#') === 0) {
                $query = $query->where(function($query) use ($search) {
                    $s = ltrim($search, '#');
                    $query->orWhere('id',"=",  "$s");
                });
            }
            else {
                $query = $query->where(function($query) use ($search) {
                    $query->orWhere('id',"like",  "%$search%")
                        ->orWhere("order_title", "like", "%$search%");
                });
            }
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('orders.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('orders.created_at', 'asc');
                    break;
                    $query = $query->orderBy('orders.order_title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        $results = $query->paginate($limit);
    
        return $results;
    }

}