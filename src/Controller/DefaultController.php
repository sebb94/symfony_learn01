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
use App\Services\ServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
class DefaultController extends AbstractController
{
      public function __construct(RandomNum $numbers, $logger){
            $numbers->numbers = [100,200,300,400,500,111,123,13,413,123];

        }

    /**
     * @Route("/home", name="home")
     */
    public function index(RandomNum $numbers, Request $request, SessionInterface $session, ServiceInterface $service, ContainerInterface $container)
    {
        $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $entityManager = $this->getDoctrine()->getManager(); 
       

        $cache = new TagAwareAdapter(
            new FilesystemAdapter()
        );


        $acer = $cache->getItem('acer');
        $dell = $cache->getItem('dell');
        $ibm = $cache->getItem('ibm');
        $apple = $cache->getItem('apple');

        if( !$acer->isHit() ){
            $acer_from_db = 'acer laptop';
            $acer->set($acer_from_db);
            $acer->tag(['computers,laptops,acer']);
            $cache->save($acer);
            dump('acer laptop from DB...');
        }
        if( !$dell->isHit() ){
            $dell_from_db = 'dell laptop';
            $dell->set($dell_from_db);
            $dell->tag(['computers,laptops,dell']);
            $cache->save($dell);
            dump('dell laptop from DB...');
        }
        if( !$ibm->isHit() ){
            $ibm_from_db = 'ibm desktop';
            $ibm->set($ibm_from_db);
            $ibm->tag(['computers,desktop,ibm']);
            $cache->save($ibm);
            dump('ibm desktop from DB...');
        }
        if( !$apple->isHit() ){
            $apple_from_db = 'apple desktop';
            $apple->set($apple_from_db);
            $apple->tag(['computers,desktop,apple']);
            $cache->save($apple);
            dump('apple desktop from DB...');
        }

        $cache->invalidateTags(['ibm']);
        $cache->invalidateTags(['laptops']);
        $cache->invalidateTags(['computers']);
        dump($acer->get());
        dump($dell->get());
        dump($ibm->get());
        dump($apple->get());  
         

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
