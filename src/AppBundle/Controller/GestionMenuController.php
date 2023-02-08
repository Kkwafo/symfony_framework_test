<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\MenuType;
use AppBundle\Entity\Menu;


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
            var_dump($menu);
            $menu->setFechaCreacion(new \DateTime());
            $em = $this->getDoctrine() -> getManager();
            $em->persist($menu);
            $em->flush($menu);
            return $this->redirectToRoute('menu', array ('id' =>$menu->getId()));
        }

        return $this->render('gestionMenu/nuevoMenu.html.twig', array('form'=> $form->createView()));
    }

}
?>