<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class DynamicSetting extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $fillable = ['name','slug','status','description','icon'];

    protected array $translatable = ['name','description'];

    public function attributeCategories(): HasMany
    {
        return $this->hasMany(AttributeCategory::class);
    }
}
