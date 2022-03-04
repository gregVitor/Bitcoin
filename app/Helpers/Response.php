<?php

if (!function_exists('apiResponse')) {
    /**
     * Standardizes the return of the Response
     *
     * @param $message
     * @param $status
     * @param $data
     *
     * @return json
     */
    function apiResponse(
        String $message,
        Int $status,
        $data = null
    ) {
        if (null !== $data) {
            return response()->json([
                'status'  => $status,
                'message' => $message,
                'data'    => $data
            ], $status);
        }

        return response()->json([
            'status'  => $status,
            'message' => $message
        ], $status);
    }
}
