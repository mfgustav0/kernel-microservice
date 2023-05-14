<?php

namespace App\Modules\Shared\Traits;

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