<?php

namespace Deft\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SingleTextDateType extends AbstractType
{
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // Convert format to lower string to match bootstrap-datepicker format
        $view->vars['date_format'] = strtolower($options['format']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy'
        ]);
    }

    public function getParent()
    {
        return 'date';
    }

    public function getName()
    {
        return 'single_text_date';
    }
}
