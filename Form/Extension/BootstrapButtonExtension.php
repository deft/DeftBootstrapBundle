<?php

namespace Deft\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BootstrapButtonExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'button';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'type' => 'default',
            'size' => ''
        ]);

        $resolver->setAllowedValues([
            'type' => ['default', 'primary', 'success', 'info', 'warning', 'danger', 'inverse', 'link'],
            'size' => ['large', 'small', 'mini', '']
        ]);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $classes = ['btn'];
        if ($options['type'] != 'default') $classes[] = sprintf("btn btn-%s", $options['type']);
        if ($options['size']) $classes[] = sprintf("btn-%s", $options['size']);
        if (isset($view->vars['attr']['class'])) $classes[] = $view->vars['attr']['class'];

        $view->vars['attr']['class'] = implode(' ', $classes);
    }
}
