<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 *
 * @property integer id
 * @property string title
 * @property double price
 * @property integer quantity
 * @property integer created_at
 * @property integer updated_at
 */

class Product extends Model
{
    use HasFactory;

    const PAGINATION_DEFAULT_LIMIT = 40;

    protected $fillable = ['title', 'price', 'quantity'];

    public static function tableName(): string
    {
        return 'products';
    }

    public function productOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductOption::class, 'product_id', 'id');
    }
}
