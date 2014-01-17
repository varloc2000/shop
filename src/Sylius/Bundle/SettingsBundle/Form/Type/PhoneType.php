<?php

namespace Sylius\Bundle\SettingsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhoneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operator', 'text', array(
                'label' => 'sylius.form.phone.operator'
            ))
            ->add('number', 'text', array(
                'label' => 'sylius.form.phone.number'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        // $resolver
        //     ->setDefaults(array(
        //         'validation_groups' => $this->validationGroups,
        //     ))
        // ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_phone';
    }
}
