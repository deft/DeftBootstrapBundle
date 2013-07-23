<?php

namespace Deft\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompositeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['children'] as $child)
        {
            $builder->add($child[0], $child[1], array_merge($child[2], ['error_bubbling' => true]));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'error_bubbling' => false,
            'children' => []
        ]);

        $resolver->setAllowedTypes(['children' => 'array']);
    }

    public function getName() { return 'composite'; }
    public function getParent() { return 'form'; }
}
