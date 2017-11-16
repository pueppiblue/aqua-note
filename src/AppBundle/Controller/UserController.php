<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserRegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function registerAction()
    {
        $form = $this->createForm(UserRegistrationForm::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->handleRequest();
        }

        return $this->render('user/register.html.twig', [
           'form' => $form->createView()
        ]);
    }
}