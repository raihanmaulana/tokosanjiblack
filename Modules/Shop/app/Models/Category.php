<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\CategoryFactory;
use App\Traits\UuidTrait;

class Category extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'shop_categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
    public function children()
    {
        return $this->hasMany('Modules\Shop\Entities\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Shop\Entities\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('Modules\Shop\Entities\Product', 'shop_categories_products', 'product_id', 'category_id');
    }
}
