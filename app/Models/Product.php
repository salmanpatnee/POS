<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'description',
        'image',
        'quantity',
        'purchase_price',
        'sale_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $with = ['category'];

    public function getImage(){
        return isset($this->image) ? asset('storage/' . $this->image) : '/img/product-placeholder.png';
    }
}
