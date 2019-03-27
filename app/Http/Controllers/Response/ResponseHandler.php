<?php

namespace App\Http\Controllers\Response;

use App\Helpers\ResponseCode;
use App\Http\Transformers\OptimusPrime;
use Carbon\Carbon;

trait ResponseHandler
{
    public $transform;

    protected function setTransformer($transform)
    {
        $this->transform = $transform;
    }

    protected function successResponse($data, $transform = true, $include = null)
    {
        if (is_null($data)) {
            $data = [];
        }

        if (property_exists($this, 'useTransform')) {
            $transform = $this->useTransform;
        }

        if ($transform) {
            $response = array_merge([
                'code'   => ResponseCode::OK,
                'status' => 'success',
            ], $this->transform($data, $include));
        } else {
            $response = array_merge([
                'code'   => ResponseCode::OK,
                'status' => 'success',
            ], $data);
        }

        return response()
            ->json($response, ResponseCode::OK, [
//                'Cache-Control' => 'max-age=9000',
            ]);
    }

    private function transform($data, $include)
    {
        try {
            $optimus = app()->make(OptimusPrime::class);
            return $optimus->transform($data, $this->transform, $include);
        } catch (\Exception $e) {
            throw $e;
        } catch (\Throwable $t) {
            throw $t;
        }
    }

    protected function notFoundResponse()
    {
        $response = [
            'code'    => ResponseCode::NOT_FOUND,
            'status'  => 'error',
            'data'    => 'Resource Not Found',
            'message' => 'Not Found',
        ];
        return response()->json($response, $response['code']);
    }


    public function deleteResponse()
    {
        $response = [
            'code'    => ResponseCode::OK,
            'status'  => 'success',
            'data'    => [],
            'message' => 'Resource Deleted',
        ];
        return response()->json($response, $response['code']);
    }



}
