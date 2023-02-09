<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\MenuType;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;
use AppBundle\Entity\Ingrediente;
use AppBundle\Form\IngredientesType;

    /**
     * @Route("/gestion")
     */
class GestionMenuController extends Controller {

    /**
     * @Route("/nuevoMenu", name="nuevoMenu")
     */
    public function nuevoMenuAction(Request $request){
   
        $menu = new Menu();

        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $menu = $form->getData();
            $menu->setFechaCreacion(new \DateTime());
            $em = $this->getDoctrine() -> getManager();
            $em->persist($menu);
            $em->flush($menu);
            return $this->redirectToRoute('menu', array ('id' =>$menu->getId()));
        }

        return $this->render('gestionMenu/nuevoMenu.html.twig', array('form'=> $form->createView()));
    }

    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */

    public function nuevaCatAction(Request $request){
   
        $categoria = new Categoria();

        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $categoria = $form->getData();
            $em = $this->getDoctrine() -> getManager();
            $em->persist($categoria);
            $em->flush($categoria);
            return $this->redirectToRoute('categoria', array ('id' =>$categoria->getId()));
        }

        return $this->render('gestionMenu/nuevaCategoria.html.twig', array('form'=> $form->createView()));

        
    }


    /**
     * @Route("/nuevoIngrediente", name="nuevoIngrediente")
     */

    public function nuevoIngAction(Request $request){
   
        $ingredientes = new Ingrediente();

        $form = $this->createForm(IngredientesType::class, $ingredientes);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ingredientes = $form->getData();
            $em = $this->getDoctrine() -> getManager();
            $em->persist($ingredientes);
            $em->flush($ingredientes);
            return $this->redirectToRoute('ingredientes', array ('id' =>$ingredientes->getId()));
        }

        return $this->render('gestionMenu/nuevoIngrediente.twig', array('form'=> $form->createView()));

    }
    
}
?>