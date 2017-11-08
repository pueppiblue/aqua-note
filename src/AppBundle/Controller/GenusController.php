<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/{genusName}")
     * @throws \RuntimeException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function showAction($genusName)
    {
        $templating = $this->container->get('templating');

        $html = $templating->render(
            'genus/show.html.twig',
            ['name' => $genusName
            ]);

        return new Response($html);
    }

}