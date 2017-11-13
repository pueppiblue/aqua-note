<?php

namespace AppBundle\Form;

use AppBundle\Entity\Genus;
use AppBundle\Repository\SubFamilyEntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\SubFamily;

class GenusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('subfamily', EntityType::class, [
                'class' => SubFamily::class,
                'placeholder' => 'Choose a Sub Family!',
                'query_builder' => function(SubFamilyEntityRepository $repo) {
                    return $repo->createAlphabeticalQueryBuilder();
                },
            ])
            ->add('speciesCount')
            ->add('funFact')
            ->add('isPublished', ChoiceType::class, [
                'choices' => ['Yes' => true, 'No' => false]
            ])
            ->add('firstDiscoveredAt', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Genus::class
        ]);
    }

    public function getBlockPrefix(): ?string
    {
        return 'genus_type';
    }
}
