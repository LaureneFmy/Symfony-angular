<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/create")
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'New User'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect('/view-user/' . $user->getId());
        }

        return $this->render(
            'user/view.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/user/update/{id}")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function updateUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'There are no user with the following id: ' . $id
            );
        }
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'New User'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user = $form->getData();
            $em->flush();
            return $this->redirect('/view-user/' . $id);
        }
        return $this->render(
            'user/edit.html.twig',
            array('form' => $form->createView())
        );
    }
}
