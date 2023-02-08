<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
        $input = "form-control mb-2";
        $button = "btn btn-dark mb-2";

        $builder
        ->add('nombre', TextType::class, array('attr' => array('class' => $input)))
        ->add('descripcion', TextareaType::class, array('attr' => array('class' => $input)))         
        ->add('foto', TextType::class, array('attr' => array('class' => $input)))
        ->add('Crear', SubmitType::class,array('attr' => array('class' => $button )));
        
    }
}
