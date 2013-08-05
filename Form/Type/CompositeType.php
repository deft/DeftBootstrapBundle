<?php

namespace Deft\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompositeType extends AbstractType
{
    private $typesNotSupportingErrorBubbling;

    public function __construct(array $typesNotSupportingErrorBubbling)
    {
        $this->typesNotSupportingErrorBubbling = $typesNotSupportingErrorBubbling;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['children'] as $child)
        {
            $childOptions = $this->resolveChildOptions($options['child_options'], $child);
            $builder->add($child[0], $child[1], $childOptions);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'error_bubbling' => false,
            'children' => [],
            'child_options' => []
        ]);

        $resolver->setAllowedTypes(['children' => 'array']);
    }

    private function resolveChildOptions(array $globalChildOptions, array $child)
    {
        $type = is_string($child[1]) ? $child[1] : (
            $child[1] instanceof AbstractType ? $child[1]->getName() : ''
        );

        $childOptions = array_merge(
            isset($child[2]) ? $child[2] : [],
            in_array($type, $this->typesNotSupportingErrorBubbling) ? [] : ['error_bubbling' => true]
        );

        return array_merge($globalChildOptions, $childOptions);
    }

    public function getName() { return 'composite'; }
    public function getParent() { return 'form'; }
}
