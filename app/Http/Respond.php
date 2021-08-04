<?php

namespace App\Http;

use Illuminate\Pagination\LengthAwarePaginator;

class Respond
{
    public static function success($data)
    {
        if (is_object($data) && $data->resource instanceof LengthAwarePaginator) {
            $data = [
                'list' => $data,
                'total' => $data->resource->total(),
                'current' => $data->resource->currentPage(),
                'end' => $data->resource->nextPageUrl() === null,
                'page_size' => $data->resource->perPage()
            ];
            return $data;
        }

        return $data;
    }

    public static function fail($errorMessage = 'error message', $statusCode = 200, $errorCode = -1)
    {
        return response()->json([
            'success' => false,
            'data' => '',
            'error_code' => $errorCode,
            'error_message' => $errorMessage
        ], $statusCode);
    }
}
