<?php

namespace App\Models\Tenant;

use App\Domain\Shared\Enum\AttributeTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Crypt;

class CategoryAttributeValue extends Pivot
{
    use HasFactory;

    protected $table = 'attribute_value';

    protected $fillable = ['value','attribute_type'];


    public function getValueAttribute($value): string|null
    {
        if ($this->attributes['attribute_type'] === AttributeTypeEnum::PASSWORD->value && !empty($value)) {
            return unserialize(Crypt::decryptString($value));
        } else {
            return $value;
        }
    }
}
