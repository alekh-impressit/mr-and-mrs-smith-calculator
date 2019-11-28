<?php
namespace Calculator\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Calculator\Controller\BaseController;

/**
 * Class MainController
 */
class MainController extends BaseController
{
    /**
     * Website
     *
     * @Route("/{url}", name="website_index", defaults={"url": null}, requirements={"url" = ".*"}, methods={"GET"})
     * @Template("Web/web.html.twig")
     *
     * @return array
     */
    public function webAction(): array
    {
        return [];
    }
}
