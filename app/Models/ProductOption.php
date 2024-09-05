<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class ProductOption
 * @package App\Models
 *
 * @property integer id
 * @property string title
 * @property string value
 * @property integer product_id
 * @property integer created_at
 * @property integer updated_at
 */
class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'product_id', 'value'];

    public static function tableName(): string
    {
        return 'product_options';
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }
}
