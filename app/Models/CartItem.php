<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    // 設定可以更改的欄位，其他欄位皆不能修改
    // protected $fillable = ['quantity'];

    // 與 $fillable 相反，只有設定的欄位不能修改
    protected $guarded = [''];

    // 取得時隱藏 JSON 屬性
    // protected $hidden = ['created_at', 'updated_at'];

    // 附加值到 JSON 裡
    protected $appends = ['current_price'];

    // $appends 需要使用的存取器
    public function getCurrentPriceAttribute()
    {
        return $this->quantity * 10;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
