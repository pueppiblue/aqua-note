<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Genus;
use AppBundle\Form\GenusType;
use Doctrine\ORM\OptimisticLockException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class GenusAdminController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {
        $genuses = $this->getDoctrine()
            ->getRepository('AppBundle:Genus')
            ->findAll();

        return $this->render('admin/genus/list.html.twig', array(
            'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/new", name="admin_genus_new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm( GenusType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genus = $form->getData();
            $repo = $this->getDoctrine()->getRepository(Genus::class);

            try {
                $repo->save($genus);
            } catch (OptimisticLockException $e) {
                // todo: throw an error
            }

            $this->addFlash('success', 'New Genus created');

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/new.html.twig', [
            'genusForm' => $form->createView()

        ]);
    }

    /**
     * @Route("/genus/{id}/edit", name="admin_genus_edit")
     * @param Genus $genus
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAction(Genus $genus, Request $request)
    {
        $form = $this->createForm( GenusType::class, $genus);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo = $this->getDoctrine()->getRepository(Genus::class);

            try {
                $repo->save($genus);
            } catch (OptimisticLockException $e) {
                // todo: throw an error
            }

            $this->addFlash('success', 'Genus updated!');

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/edit.html.twig', [
            'genusForm' => $form->createView()

        ]);
    }
}