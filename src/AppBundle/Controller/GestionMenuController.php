<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Menu;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GestionMenuController extends Controller {

    /**
     * @Route("/nuevoMenu", name="nuevoMenu")
     */
    public function nuevoMenuAction(Request $request)
    {
        $menu = new Menu();
        $formBuilder = $this->createFormBuilder($menu)
        ->add('nombre', TextType::class)
        ->add('descripcion', TextareaType::class)
        ->add('foto', TextType::class)
        ->add('fechaCreacion', DateType::class)
        ->add('top', CheckboxType::class);
        $form = $formBuilder->getForm();

        return $this->render('gestionTapas/nuevoMenu.html.twig', array('form'=> $form->createView()));
    }

}
?>