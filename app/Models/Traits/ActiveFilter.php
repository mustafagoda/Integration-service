<?php

namespace App\Models\Traits;

use App\Models\Scopes\ActiveScope;

trait ActiveFilter
{
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }
}
