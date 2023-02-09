<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

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


    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request){
   
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('replace_with_some_route');
            }
            
            return $this->render('frontal/registro.html.twig',array('form' => $form->createView()));
    }

     /**
     * @Route("/{pagina}", name="home")
     */
    public function homeAction(Request $request, $pagina=1)
    {
        $MenuRepository = $this->getDoctrine()->getRepository(Menu::class);
        
        //le paso como argumento la cantidad que quiero que muestre y el default del valor pagina.
        $menu=$MenuRepository->paginaActual($nummenu=3,$pagina);

        return $this->render('frontal/home.html.twig', array('menu'=>$menu, 'paginaActual'=>$pagina));
    }
}
