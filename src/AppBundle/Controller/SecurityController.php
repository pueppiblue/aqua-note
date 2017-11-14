<?php

namespace AppBundle\Controller;


use AppBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');

        $lastError = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername
        ]);

        return $this->render(
            'security/login.html.twig', [
                'form' => $form->createView(),
                'error' => $lastError
            ]
        );
    }

    public function logoutAction()
    {
        throw new Exception('This should not be reached.');
    }
}