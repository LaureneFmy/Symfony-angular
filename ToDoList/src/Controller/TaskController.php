<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskController extends AbstractController
{

    /**
	* @Route("/create-task")
	*/
	public function createAction(Request $request) {
		$task = new Task();
		$form = $this->createFormBuilder($task)
			->add('name', TextType::class)
			->add('description', TextType::class)
			->add('status', TextType::class)
			->add('save', SubmitType::class, array('label' => 'New Task'))
			->getForm();
        $form->handleRequest($request);
        
		if ($form->isSubmitted()) {
			$task = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->persist($task);
			$em->flush();
			return $this->redirect('/view-task/' . $task->getId());
		}
		return $this->render(
			'task/edit.html.twig',
			array('form' => $form->createView())
			);
	}
	
	/**
	* @Route("/view-task/{id}")
	*/   
	public function viewAction($id) {
		$task = $this->getDoctrine()
			->getRepository(Task::class)
			->find($id);
		if (!$task) {
			throw $this->createNotFoundException(
			'There are no task with the following id: ' . $id
			);
		}
		return $this->render(
			'task/view.html.twig',
			array('task' => $task)
			);
	}	
	
	/**
    * @Route("/show-task")
    * @param $user_id
	*/  
	public function showAction($user_id) {
		$tasks = $this->getDoctrine()
			->getRepository(Task::class)
			->findBy(
                array('user_id'  => $user_id)
            );
		return $this->render(
			'task/show.html.twig',
			array('tasks' => $tasks)
			);
	}
	
	/**
	* @Route("/delete-task/{id}")
	*/ 
	public function deleteAction($id) {
		$em = $this->getDoctrine()->getManager();
		$task = $em->getRepository(Task::class)->find($id);
		if (!$task) {
			throw $this->createNotFoundException(
			'There are no tasks with the following id: ' . $id
			);
		}
		$em->remove($task);
		$em->flush();
		return $this->redirect('/show-tasks');
	}
	
	/**
	* @Route("/update-task/{id}")
	*/  
	public function updateAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$task = $em->getRepository(Task::class)->find($id);
		if (!$task) {
			throw $this->createNotFoundException(
			'There are no articles with the following id: ' . $id
			);
		}
		$form = $this->createFormBuilder($task)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('status', TextType::class)
			->add('save', SubmitType::class, array('label' => 'Update'))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted()) {
			$form = $form->getData();
			$em->flush();
			return $this->redirect('/view-task/' . $id);
		}
		return $this->render(
			'/edit.html.twig',
			array('form' => $form->createView())
			);
	}
	
}

