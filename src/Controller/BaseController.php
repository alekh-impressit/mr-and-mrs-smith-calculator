<?php
namespace Calculator\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Calculator\Exception\InternalServerException;

/**
 * Class BaseController
 */
class BaseController extends AbstractController
{
    /**
     * Get parameters by request.
     *
     * @param Request $request
     * @param bool $canBeEmpty
     *
     * @return ParameterBag
     *
     * @throws InternalServerException
     */
    protected function getParametersBag(Request $request, $canBeEmpty = false): ParameterBag
    {
        $parameters = new ParameterBag(\json_decode($request->getContent(), true) ?: ($canBeEmpty ? [] : false));
        if (!$canBeEmpty && $parameters == false) {
            throw new InternalServerException('Invalid request');
        }

        return $parameters;
    }
}
