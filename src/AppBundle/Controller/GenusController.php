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
        $funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second.';

        $mdParser = $this->container->get('markdown.parser');
        $funFact = $mdParser->transform($funFact);

        return $this->render(
            'genus/show.html.twig',
            [
                'name' => $genusName,
                'funFact' => $funFact,
            ]
        );
    }

    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes")
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