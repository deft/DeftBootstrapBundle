<?php

namespace Deft\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BootstrapChoiceExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return 'choice';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['inline' => false]);
        $resolver->setAllowedTypes(['inline' => 'bool']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['inline'] = $options['inline'];
    }
}
