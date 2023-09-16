<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Author;

class AuthorEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Author::class;
    }

    public function filterAuthors($sort_filter, $status, $keyword) {
        $query = $this->model->select('authors.*');
    
        if ($status == 0 || $status == 1) {
            $query = $query->where('authors.status', $status);
        }
    
        if ($keyword) {
            $query = $query->where("name","like", "%$keyword%");
        }
    
        if ($sort_filter) {
            switch ($sort_filter) {
                case 'latest':
                    $query = $query->orderBy('authors.created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('authors.created_at', 'asc');
                    break;
                case 'a_z':
                    $query = $query->orderBy('authors.name', 'asc');
                    break;
                case 'z_a':
                    $query = $query->orderBy('authors.name', 'desc');
                    break;
                default:
                    break;
            }
        }
    
        return $query->get();
    }
}
