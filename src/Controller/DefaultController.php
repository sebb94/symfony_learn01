<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;
use App\Services\RandomNum;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
class DefaultController extends AbstractController
{
      public function __construct(RandomNum $numbers, $logger){
            $numbers->numbers = [100,200,300,400,500,111,123,13,413,123];

        }

    /**
     * @Route("/home", name="home")
     */
    public function index(RandomNum $numbers, Request $request, SessionInterface $session)
    {
        $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

      //  $repository = $this->getDoctrine()->getRepository(User::class);
       $entityManager = $this->getDoctrine()->getManager(); 

    
        $user1 = $this->getDoctrine()->getRepository(User::class)->find(1);  
        $user2 = $this->getDoctrine()->getRepository(User::class)->find(2); 
        $user3 = $this->getDoctrine()->getRepository(User::class)->find(3); 
        $user4 = $this->getDoctrine()->getRepository(User::class)->find(4); 

        // $user1->addFollowed($user2);
        // $user1->addFollowed($user3);
        // $user1->addFollowed($user4);
        // $entityManager->flush();
        // for ($i = 1; $i <= 4; $i++){
        //     $user = new User();
        //     $user->setName('Seba - ' . $i);
        //     $entityManager->persist($user);
        // }
        // $entityManager->flush();

        print_r($user1->getFollowed()->count());
        echo "<br>";
        print_r($user1->getFollowing()->count());
        echo "<br>";
        print_r($user4->getFollowing()->count());    

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'numbers' => $numbers->numbers
        ]);

    }

    public function popularPosts($number = 3){

        // database call
        $posts = ['post 1', 'post 2', 'post 3'];

        return $this->render(('default/most_popular.html.twig'), [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */

    public function generate_url(){

           exit($this->generateUrl(
            'generate_url',
            array('param' => 20),
            UrlGeneratorInterface::ABSOLUTE_URL

        )
    );
    }
     
     /**
     * @Route("/download")
     */
    
    public function download(){

        $path = $this->getParameter('download_directory');
        return $this->file($path.'notes.txt');

    }

       /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test redirection');
    }

    /**
     * @Route("/forwarding-to-controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController::methodToForwardTo',
            array('param'  => '1')
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }


}
