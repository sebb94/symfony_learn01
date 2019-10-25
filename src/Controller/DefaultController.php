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
        $users = [
            "Seba",
            "Marian",
            "Włodek"
        ];

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User;
        $user->setName("Seba");
        $entityManager->persist($user);
        exit($entityManager->flush());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);

        //    return $this->json(["Name" => "Seba", "x" => 10]);

            // return $this->json(["Name" => $name, "x" => 10]);

            // return $this->redirectToRoute("default2");
    }


}
