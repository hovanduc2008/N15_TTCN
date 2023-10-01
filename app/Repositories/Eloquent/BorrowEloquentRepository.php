<?php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseEloquentRepository;
use App\Models\Borrow;

class BorrowEloquentRepository extends BaseEloquentRepository {
    public function model() {
        return Borrow::class;
    }
}