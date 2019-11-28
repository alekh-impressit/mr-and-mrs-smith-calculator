<?php
namespace Calculator\Exception;

use Exception;
use Throwable;

/**
 * Class CalculatorException
 */
class CalculatorException extends Exception
{
    /**
     * @var string
     */
    protected $internalCode;

    /**
     * @var array
     */
    protected $extra;

    /**
     * CalculatorException constructor.
     * @param string $message
     * @param int $code
     * @param string $internalCode
     * @param Throwable|null $previous
     * @param array|null $extra
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        string $internalCode = InternalServerException::CODE,
        Throwable $previous = null,
        array $extra = null
    ) {
        $this->internalCode = $internalCode;
        $this->extra = $extra;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return array|null
     */
    public function getExtra(): ?array
    {
        return $this->extra;
    }

    /**
     * @return string
     */
    public function getInternalCode(): string
    {
        return $this->internalCode;
    }
}
