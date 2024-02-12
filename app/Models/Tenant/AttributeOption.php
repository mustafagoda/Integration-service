<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeOption extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'attributable_type',
        'attributable_id',
        'attribute_id',
    ];

    public function attributable(): MorphTo
    {
        return $this->morphTo();
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
