<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $input = "form-control mb-2";
        $button = "btn btn-dark mb-2";
        
        $builder
        ->add('nombre', TextType::class, array('attr' => array('class' => $input)))
        ->add('descripcion', TextareaType::class, array('attr' => array('class' => $input)))
        ->add('ingredientes', EntityType::class, array('class' => 'AppBundle:Ingrediente', 'multiple' => 'true'))  
        ->add('categoria', EntityType::class, array('class' => 'AppBundle:Categoria'))    
        ->add('foto', TextType::class, array('label' => 'Foto URL'))         
        ->add('top')        
        ->add('Crear', SubmitType::class,array('attr' => array('class' => $button )));
        
    }
}
