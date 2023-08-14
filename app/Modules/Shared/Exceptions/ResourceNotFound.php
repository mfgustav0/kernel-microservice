<?php

namespace App\Modules\Shared\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class ResourceNotFound extends Exception implements Responsable
{
    protected $code = 404;
    protected $message = 'Resource not found';

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return response()->json([
            'message' => $this->message
        ], $this->code);
    }
}