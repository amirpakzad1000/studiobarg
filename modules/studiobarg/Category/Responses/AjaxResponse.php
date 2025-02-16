<?php

namespace studiobarg\Category\Responses;

class AjaxResponse
{
    public static function successResponse()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'عملیات با موفقیت انجام شد'
        ], 200);
    }//End Method

    public static function errorResponse()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'مشکلی در عملیات رخ داده است!'
        ], 500);
    }//End Method7777
}
