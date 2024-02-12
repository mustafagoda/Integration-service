<?php

namespace App\Models\Tenant;

use App\Models\Traits\ActiveFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AttributeCategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use ActiveFilter;
    use SoftDeletes;

    protected $fillable = ['name','slug','status','description','icon'];

    protected array $translatable = ['name','description'];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_value')
            ->using(CategoryAttributeValue::class)
            ->withPivot('value','attribute_type')
            ->withTimestamps();
    }

    public function dynamicSetting(): BelongsTo
    {
        return $this->belongsTo(DynamicSetting::class);
    }
}
