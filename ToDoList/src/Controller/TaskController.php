<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController

{

    /**
     * @Route("user/{user_id}/task/{id}", name="task.view")
     * @param $id
     * @return Response
     */
    public function viewAction($id)
    {
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
     * @Route("user/{user_id}/tasks", name="task.show")
     * @param $user_id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function showAction($user_id, EntityManagerInterface $em) : Response
    {
        $taskList = $em->getRepository(Task::class)->findBy(
            array('user_id'  => $user_id)
        );
        $array=[];
        foreach ($taskList as $task) {
            array_push($array,[
                'id'            => $task->getId(),
                'name'          => $task->getName(),
                'description'   => $task->getDescription(),
                'status'        => $task->getStatus(),
                'user_id'       => $task->getUserId()->getId()
            ]);
        }
        return $this->render(
            'task/show.html.twig',
            array('tasks' => $array)
        );
    }


    /**
     * @Route("user/{user_id}/task/delete/{id}", name="task.delete")
     * @param $id
     * @return RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('App:Task')->find($id);
        if (!$task) {
            throw $this->createNotFoundException(
                'There are no tasks with the following id: ' . $id
            );
        }
        $em->remove($task);
        $em->flush();
        return $this->redirect('/tasks');
    }

    /**
     * @Route("user/{user_id}/task/update/{id}", name="task.update")
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('App:Task')->find($id);
        if (!$task) {
            throw $this->createNotFoundException(
                'There are no tasks with the following id: ' . $id
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
            'task/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("user/{user_id}/task_create", name="task.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function createAction(Request $request, EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->findOneBy($request->request->get('user_id'));
        $task = new Task();
        $task->setName($request->request->get('name'));
        $task->setDescription($request->request->get('description'));
        $task->setStatus($request->request->get('status'));
        $task->setUserId($user);
        $em->persist($task);
        $em->flush();
        return $this->redirect('/task/{id}' . $task->getId());
    }

}