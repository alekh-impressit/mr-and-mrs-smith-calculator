<?php
namespace Calculator\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;
use Calculator\Exception\CalculatorException;

/**
 * Class ResponseHelper
 */
class ResponseHelper
{
    /**
     * Return JSON response with exception data.
     *
     * @param CalculatorException $exception
     *
     * @return JsonResponse
     */
    public static function errorJsonResponse(CalculatorException $exception): JsonResponse
    {
        $result = new JsonResponse();
        $errorData = [
            'error' => [
                'code' => $exception->getInternalCode(),
                'message' => $exception->getMessage()
            ]
        ];

        if ($exception->getExtra()) {
            $errorData['error']['extra'] = $exception->getExtra();
        }

        $result->setData($errorData);
        $result->setStatusCode($exception->getCode());

        return $result;
    }

    /**
     * Return JSON response.
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function successJsonResponse(array $data = null): JsonResponse
    {
        $result = new JsonResponse();
        $result->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        if ($data !== null) {
            $response = [
                'data' => $data
            ];

            $result->setData($response);
        }

        return $result;
    }
}
