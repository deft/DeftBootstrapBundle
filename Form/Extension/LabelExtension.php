<?php

namespace Deft\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LabelExtension extends AbstractTypeExtension
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'render_label' => true
        ]);

        $resolver->setAllowedTypes(['render_label' => 'bool']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['render_label'] = $options['render_label'];
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}
