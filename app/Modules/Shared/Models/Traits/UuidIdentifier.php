<?php

namespace App\Modules\Shared\Models\Traits;

trait UuidIdentifier
{
    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }
}