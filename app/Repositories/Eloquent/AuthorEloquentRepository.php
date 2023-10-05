<?php
namespace App\Repositories\Eloquent;

use App\Repositories\BaseEloquentRepository;
use App\Models\Author;

class AuthorEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Author::class;
    }

    public function filterAuthors($limit ,$sort_filter, $id, $name, $phone_number) {
        $query = $this->model->select('authors.*');
    
        if ($id) {
            $query = $query->where('id', $id);
        }
    
        if ($name) {
            $query = $query->where("name","like", "%$name%");
        }

        if ($phone_number) {
            $query = $query->where("phone_number", $phone_number);
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
    
        $results = $query->paginate($limit);
    
        return $results;
    }
}
