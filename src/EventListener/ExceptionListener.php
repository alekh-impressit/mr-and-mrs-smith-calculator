<?php
namespace Calculator\EventListener;

use Calculator\Exception\InternalServerException;
use Calculator\Exception\CalculatorException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Monolog\Logger;
use Exception;
use Calculator\Helper\ResponseHelper;

/**
 * Class ExceptionListener
 */
class ExceptionListener
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        /** @var CalculatorException $exception */
        $exception = $event->getThrowable();
        if (!$exception instanceof CalculatorException) {
            $exception = new InternalServerException($exception->getMessage(), $exception);
        }

        if ($exception instanceof InternalServerException) {
            $this->logger->critical($this->getErrorLogMessage($exception));
        }

        $response = ResponseHelper::errorJsonResponse($exception);
        $event->setResponse($response);
    }

    /**
     * Get log error message by exception
     *
     * @param Exception $exception
     *
     * @return string
     */
    public function getErrorLogMessage(Exception $exception): string
    {
        $errMessage = "Message: " . $exception->getMessage()
            . ";\n File: " . $exception->getFile()
            . ";\n Line:" . $exception->getLine()
            . ";\n Trace: " . $exception->getTraceAsString();

        if ($exception->getPrevious()) {
            $errMessage .= ";/n Previous: " . $this->getErrorLogMessage($exception->getPrevious());
        }

        return $errMessage;
    }
}
