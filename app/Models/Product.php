<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Borrow;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ISBN',
        'added_by',
        'title',
        'slug',
        'image',
        'thumbnail',
        'price',
        'quantity',
        'author_id',
        'category_id',
        'description',
        'publication_date',
        'content',
        'meta_title',
        'meta_description',
        'type',
        'deleted_at',
        'status'
    ];

    public function borrowing() {
        return $this->hasMany(Borrow::class, 'product_id')-> whereNull('actual_return_date');
    }

}
