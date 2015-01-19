<?php

namespace Academic\Bundle\ProjectBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label' => 'academic.project.name.label',
                    'required' => true,
                )
            )
            ->add(
                'summary',
                'textarea',
                array(
                    'label' => 'academic.project.summary.label',
                    'required' => true,
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Academic\Bundle\ProjectBundle\Entity\Project',
                'intention'  => 'project',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'academic_project';
    }
}
