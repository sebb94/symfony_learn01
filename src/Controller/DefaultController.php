<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Services\RandomNum;
class DefaultController extends AbstractController
{
      public function __construct(RandomNum $numbers){
            $numbers->numbers = [100,200,300];
        }

    /**
     * @Route("/default", name="default")
     */
    public function index(RandomNum $numbers)
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

        // $numbers = [50, 25, 32];
        // shuffle($numbers);
       

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'numbers' => $numbers->numbers
        ]);

        //    return $this->json(["Name" => "Seba", "x" => 10]);

            // return $this->json(["Name" => $name, "x" => 10]);

            // return $this->redirectToRoute("default2");
    }


}
