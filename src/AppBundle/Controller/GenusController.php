<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        return $this->render(
            'genus/show.html.twig',
            [
                'name' => $genusName,
            ]
        );
    }

    /**
     * @Route("/genus/{genusName}/notes")
     * @Method("GET")
     * @param $genusName
     * @return Response
     */
    public function getNotes($genusName)
    {

        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octo asked me a riddle, outsmartedme', 'date' => 'Aug. 20 2017'],
            ['id' => 2, 'username' => 'AquaRyan', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'Octo asked me a riddle, outsmartedme', 'date' => 'Aug. 20 2017'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octo asked me a riddle, outsmartedme', 'date' => 'Aug. 20 2017'],
        ];

        $data = [
            'notes' => $notes,
        ];

//        return new Response(json_encode($data));
        return new JsonResponse($data);

    }
}