<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object', ChoiceType::class, [
                'choices'  => [
                    'front-end' => 'front-end',
                    'bach-end' => 'bach-end',
                    'full-stack' => 'full-stack',
                    'DevOps' => 'DevOps',
                    'test' => 'test',
                ],
            ])
            ->add('description')
            ->add('entreprise')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
