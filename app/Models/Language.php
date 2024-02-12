<?php

namespace App\Models;

use App\Models\Traits\ActiveFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;
    use ActiveFilter;

    protected $fillable = ['status', 'slug', 'name', 'direction','is_default','icon'];

    protected array $translatable = ['name'];
}
