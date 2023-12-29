<?php

namespace App\Form;

use App\Entity\SearchConvertis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class SearchType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options): void
   {
      $builder
         ->add('instagram', TextType::class, [
            'label' =>  'Instagram',
            'required'  =>  false,
            'attr'  =>  [
               'placeholder'   =>  '@intagram, Téléphone', 'class' =>  'rounded border-0 pl-0'
            ]
         ])
         ->add('minDate', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
            'label' => false,
            'attr'  =>  [
               'class' =>  'rounded'
            ]
         ])
         ->add('maxDate', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
            'label' => false,
            'attr'  =>  [
               'class' =>  'rounded'
            ]
         ]);
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
      $resolver->setDefaults([
         'data_class' => SearchConvertis::class,
         'method' => 'GET',
         'csrf_protection' => false,
      ]);
   }

   public function getBlockPrefix()
   {
      return '';
   }
}
