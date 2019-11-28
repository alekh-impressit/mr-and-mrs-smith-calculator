<?php
namespace Calculator\Controller\CalculatorApi\v1_0;

use Calculator\Controller\BaseController;
use Calculator\Exception\InternalServerException;
use Calculator\Helper\ResponseHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MultiplicationOperationController
 *
 * Process multiplication operation
 *
 * @Route("/api/1.0/multiplication", name="operation_multiplication_1_0", methods={"POST"})
 */
class MultiplicationOperationController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InternalServerException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $parametersBag = $this->getParametersBag($request);

        $firstNumber = $parametersBag->get('firstNumber');
        $secondNumber = $parametersBag->get('secondNumber');

        $response = $firstNumber * $secondNumber;

        return ResponseHelper::successJsonResponse(['result' => $response]);
    }
}
