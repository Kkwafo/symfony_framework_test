<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="homepage")
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
     * @Route("{pagina}", name="home")
     */
    public function homeAction(Request $request, $pagina=1)
    {
        $MenuRepository = $this->getDoctrine()->getRepository(Menu::class);
        //$menu = $MenuRepository->findByTop(true);
  
        $menu=$MenuRepository->paginaActual($pagina);

        return $this->render('frontal/home.html.twig', array('menu'=>$menu, 'paginaActual'=>$pagina));
    }
     /**
     * @Route("/menu/{id}", name="menu")
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
    /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function catAction(Request $request,$id=null )
    {
        if($id != null){
            if (empty($id)){

                return $this->redirectToRoute('home');
            }
         
            $CategoriaRepository = $this->getDoctrine()->getRepository(Categoria::class);
            $categoria= $CategoriaRepository->find($id);
            //dump($categoria); die;
            return $this->render('frontal/categoria.html.twig', array('categoria'=>$categoria));
        } else {
            return $this->redirectToRoute('home');
        }
    }
    /**
     * @Route("/ingredientes/{id}", name="ingredientes")
     */
    public function ingAction(Request $request,$id=null )
    {
        if($id != null){
            if (empty($id)){

                return $this->redirectToRoute('home');
            }
         
            $ingredienteRepository = $this->getDoctrine()->getRepository(Ingrediente::class);
            $ingredientes= $ingredienteRepository->find($id);
            //dump($categoria); die;
            return $this->render('frontal/ingredientes.twig', array('ingredientes'=>$ingredientes));
        } else {
            return $this->redirectToRoute('home');
        }
    }

}
