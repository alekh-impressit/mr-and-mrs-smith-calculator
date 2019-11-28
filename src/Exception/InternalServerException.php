<?php
namespace Calculator\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

/**
 * Class InternalServerException
 */
class InternalServerException extends CalculatorException
{
    const CODE = 'internal_error';
    const STATUS_CODE = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
    const INTERNAL_MESSAGE = 'Sorry but something wrong.';

    /**
     * InternalServerException constructor.
     *
     * @param Throwable $previous
     * @param null|string $message
     */
    public function __construct(string $message = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::INTERNAL_MESSAGE, self::STATUS_CODE, self::CODE, $previous);
    }
}
