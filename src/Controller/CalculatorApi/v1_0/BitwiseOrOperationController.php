<?php
namespace Calculator\Controller\CalculatorApi\v1_0;

use Calculator\Controller\BaseController;
use Calculator\Exception\InternalServerException;
use Calculator\Helper\ResponseHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BitwiseOrOperationController
 *
 * Process bitwise or operation
 *
 * @Route("/api/1.0/bitwise/or", name="operation_bitwise_or_1_0", methods={"POST"})
 */
class BitwiseOrOperationController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InternalServerException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $parametersBag = $this->getParametersBag($request);

        $firstNumber = $parametersBag->getInt('firstNumber');
        $secondNumber = $parametersBag->getInt('secondNumber');

        $result = $firstNumber | $secondNumber;

        return ResponseHelper::successJsonResponse(['result' => $result]);
    }
}
