<?php

namespace UAW\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return new JsonResponse([
            'version' => '0.1',
            'Project Name' => 'Symfony2 RestApi'
        ]);
    }
}
