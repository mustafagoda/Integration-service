<?php

namespace App\Models;

use App\Models\Traits\ActiveFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ActiveFilter;
    use HasTranslations;

    protected $fillable = ['status','slug', 'name'];


    protected array $translatable = ['name'];

    public function pricingOptions(): HasMany
    {
        return $this->hasMany(PricingOption::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }
}
