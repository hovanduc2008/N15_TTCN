<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Category;

class CategoryEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Category::class;
    }

    public function filterCategories($limit ,$sort_filter, $id, $keyword) {
        $query = $this->model->select('categories.*');
    
        if ($id) {
            $query = $query->where('id', $id);
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
    
        $results = $query->paginate($limit);
    
        return $results;
    }
}