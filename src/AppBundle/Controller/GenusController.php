<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
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
        $key = md5($funFact);

        $mdParser = $this->container->get('markdown.parser');
        $cache = $this->get('doctrine_cache.providers.markdown_cache');

        if ($cache->contains($key)) {
            $funFact = $cache->fetch(($key));
        } else {
            sleep(1);
            $funFact = $mdParser->transform($funFact);
            $cache->save($key, $funFact);
        }

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

        return new JsonResponse($data); //return new Response(json_encode($data));

    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genusList = $em->getRepository(Genus::class)->findAll();


        return $this->render('genus/list.html.twig',[
            'genusList' => $genusList
        ]);


    }

    public function newAction()
    {
        $genus = new Genus();
        $genus->setName('Octopus ' . random_int(1, 100));
        $genus->setSpeciesCount(random_int(100,10000));
        $genus->setSubfamily("Septopaediae");

        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($genus);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e);
        }

        return new Response('<html><body>Genus saved.</body></html>');
    }
}
