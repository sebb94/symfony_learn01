<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {

        // Dodawaine userów
        // $entityManager = $this->getDoctrine()->getManager();
        // $user = new User;
        // $user->setName("Seba");
        // $user2 = new User;
        // $user2->setName("Marian");
        // $user3 = new User;
        // $user3->setName("Włodek");
        // $entityManager->persist($user);
        // $entityManager->persist($user2);
        // $entityManager->persist($user3);
        // exit($entityManager->flush());

        $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

       

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users
        ]);

        //    return $this->json(["Name" => "Seba", "x" => 10]);

            // return $this->json(["Name" => $name, "x" => 10]);

            // return $this->redirectToRoute("default2");
    }


}
