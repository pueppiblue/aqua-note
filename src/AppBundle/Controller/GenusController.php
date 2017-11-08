<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/genus/{genusName}")
     * @param $genusName
     * @return Response
     */
    public function showAction($genusName)
    {
        $notes = [
            'Octo asked me a riddle, outsmartedme',
            'I counted 8 legs... as they wrapped around me',
            'Inked!'
        ];

        return $this->render(
            'genus/show.html.twig',
            [
                'name' => $genusName,
                'notes' => $notes
            ]
        );
    }

}