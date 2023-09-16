<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Category;

class CategoryEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Category::class;
    }

    public function filterCategories($sort_filter, $status, $keyword) {
        $query = $this->model->select('categories.*');
    
        if ($status == 0 || $status == 1) {
            $query = $query->where('categories.status', $status);
        }
    
        if ($keyword) {
            $query = $query->where("title","like", "%$keyword%");
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('categories.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('categories.created_at', 'asc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('categories.title', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('categories.title', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        return $query->get();
    }
}