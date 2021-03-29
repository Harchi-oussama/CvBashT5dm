<?php

namespace App\Form;

use App\Entity\CDT;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class CDTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_cdt')
            ->add('prenom_cdt')
            ->add('email_cdt')
            ->add('num_cdt')
            ->add('password_cdt', PasswordType::class)
            ->add('confirmez_password_cdt', PasswordType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CDT::class,
        ]);
    }
}
