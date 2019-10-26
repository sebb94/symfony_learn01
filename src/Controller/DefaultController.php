<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function index(RandomNum $numbers, Request $request, SessionInterface $session)
    {

        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
        $this->addFlash(
            'warning',
            'Your changes were saved!'
        );

        $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
       
  
        // exit($request->query->get('page', 'value if doest exits'));


        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->$request->get('page'); // post data
        $request->files->get('foo');
      
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'numbers' => $numbers->numbers
        ]);

    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page" = "\d+"})
     */
    public function index2(){
        return new Response("BLOG");
    }

    /**
     * @Route(
     *        "/articles/{_locale}/{year}/{slug}/{category}", 
     *         defaults={"category" : "computers"},
     *          requirements={
     *              "_locale" : "pl|en",
     *              "category": "computers|rtv",
     *              "year" : "\d+"
     * })
     */
    public function index3(){
        return new Response("Categories");
    }

    /**
     * @Route({
     *      "pl": "/{_locale}/o-nas",
     *       "en": "/{_locale}/about-us"
     * }, name="about_us",)
     */
    public function index4()
    {
        return new Response('Translated routes');
    }
    

}
