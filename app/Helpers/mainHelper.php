<?php

function apiResponse($data = null, $message = '',  $code = 200)
{
    return response()->json([
        'status' => $code === 200 ? 'success' : 'error',
        'message' => $message,
        'data' => $data
    ], $code);
}
