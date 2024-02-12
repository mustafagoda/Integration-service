<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $fillable = ['name','slug','status','type','icon','tooltip','placeholder','validation'];

    protected array $translatable = ['name','placeholder','tooltip'];

    public function attributeOptions(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeCategory::class, 'attribute_value')
            ->using(CategoryAttributeValue::class)
            ->withPivot('value','attribute_type')
            ->withTimestamps();
    }
}
