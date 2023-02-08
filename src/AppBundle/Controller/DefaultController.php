<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Menu;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('frontal/index.html.twig');
    }

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        
        return $this->render('frontal/nosotros.html.twig');
    }
        /**
     * @Route("contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request,$sitio="todos")
    {
        
        return $this->render('frontal/bares.html.twig', array('sitio' => $sitio));
    }
        /**
     * @Route("/ ", name="home")
     */
    public function homeAction(Request $request)
    {
        $MenuRepository = $this->getDoctrine()->getRepository(Menu::class);
        $menu = $MenuRepository->findByTop(true);   
        return $this->render('frontal/home.html.twig', array('menu'=>$menu));
    }
            /**
     * @Route("/menu/{id} ", name="menu")
     */
    public function menuAction(Request $request,$id=null )
    {
        if($id != null){
        $MenuRepository = $this->getDoctrine()->getRepository(Menu::class);
        $menu = $MenuRepository->find($id);
        return $this->render('frontal/menu.html.twig', array('menu'=>$menu));
    } else {
        return $this->redirectToRoute('home');
    }
       
    }
    
}
