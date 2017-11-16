<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**@var User $user */
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Registered new User: '. $user->getEmail());
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/register.html.twig', [
           'form' => $form->createView()
        ]);
    }
}