<?php

namespace App\Form;

use App\Entity\RequeteHTTP;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RequeteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'GET' => "GET",
                    'POST' => "POST",
                ],
            ])
            ->add('titre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequeteHTTP::class,
        ]);
    }
}
