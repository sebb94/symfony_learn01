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
use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Image;
use App\Services\RandomNum;
use App\Services\MyService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class DefaultController extends AbstractController
{
      public function __construct(RandomNum $numbers, $logger){
            $numbers->numbers = [100,200,300,400,500,111,123,13,413,123];

        }

    /**
     * @Route("/home", name="home")
     */
    public function index(RandomNum $numbers, Request $request, SessionInterface $session, MyService $service, ContainerInterface $container)
    {
        $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $entityManager = $this->getDoctrine()->getManager(); 
       
        dump($container->get('app.myservice'));

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
