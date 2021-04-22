<?php

namespace App\Form;

use App\Entity\Ent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_ent')
            ->add('mail_ent')
            ->add('site_ent')
            ->add('adresse_ent')
            ->add('num_ent')
            ->add('ville_ent')
            ->add('img_logo_ent')
            ->add('description_ent')
            ->add('date_creation_ent')
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ent::class,
        ]);
    }
}
