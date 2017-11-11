<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use AppBundle\Service\MarkdownTransformer;
use Doctrine\Common\Collections\Collection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @param $genusName
     * @return Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($genusName)
    {
        /*
                $mdParser = $this->container->get('markdown.parser');
                $cache = $this->get('doctrine_cache.providers.markdown_cache');

                if ($cache->contains($key)) {
                    $funFact = $cache->fetch(($key));
                } else {
                    sleep(1);
                    $funFact = $mdParser->transform($funFact);
                    $cache->save($key, $funFact);
                }
        */
        $genusRepository = $this->getDoctrine()->getRepository(Genus::class);
        $genus = $genusRepository->findOneBy(['name' => $genusName]);

        if (!$genus) {
            throw $this->createNotFoundException('Genus not found.');
        }

        $recentNotes = $this->getRecentNotes($genus, 3);
        $transformer = $this->get('app.markdown_transformer');
        $funFact = $transformer->parse($genus->getFunFact());

        return $this->render(
            'genus/show.html.twig',
            [
                'genus' => $genus,
                'funFact' => $funFact,
                'recentNotesCount' => count($recentNotes),

            ]
        );
    }

    private function getRecentNotes(Genus $genus, int $monthCount)
    {

        $notesList = $this->getDoctrine()->getRepository(GenusNote::class)
            ->findAllRecentNotesForGenus($genus, $monthCount);

        return $notesList;

        /*
        /* use an ArrayCollection filter to filter by the createdAt property
        return $notes->filter(
            function (GenusNote $note) use ($monthCount) {
                return $note->getCreatedAt() > new \DateTime('-' . $monthCount . ' months');
            }
        );
        */
    }

    /**
     * @Route("/genus/{name}/notes", name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction(Genus $genus)
    {
        $notes = [];

        foreach ($genus->getNotes() as $note) {
            $notes[] = [
                'id' => $note->getId(),
                'date' => $note->getCreatedAt()->format('Y-m-d'),
                'username' => $note->getUsername(),
                'avatarUri' => '/images/' . $note->getUserAvatarFilename(),
                'note' => $note->getNote(),
            ];
        }

        $data = [
            'notes' => $notes,
        ];

        return new JsonResponse($data); //return new Response(json_encode($data));

    }

    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Genus');
        $genusList = $repo->findAllPublishedOrderedByRecentlyActive();


        return $this->render('genus/list.html.twig', [
            'genusList' => $genusList
        ]);


    }

    public function newAction()
    {
        $genus = new Genus();
        $genus->setName('Octopus ' . random_int(1, 100));
        $genus->setSpeciesCount(random_int(100, 10000));
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
