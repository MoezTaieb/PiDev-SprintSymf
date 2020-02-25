<?php

namespace CampBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefugieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomRefugie')->add('prenomRefugie')->add('adresseRefugie')
            ->add('telRefugie')->add('numassportRefugie')->add('nationaliteRefugie')
            ->add('image',FileType::class, array('data_class'=>null, 'required'=>false))
            ->add('camp');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CampBundle\Entity\Refugie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'campbundle_refugie';
    }


}
