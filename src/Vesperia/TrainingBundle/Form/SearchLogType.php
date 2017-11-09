<?php
namespace Vesperia\TrainingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vesperia\TrainingBundle\DTO\SearchDTO;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchLogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ipClient', TextType::class, ['required' => false])
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class);
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class, ['label' => 'search']);
        }
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', SearchDTO::class);
        
        $resolver->setDefault('standalone', true);
        $resolver->setAllowedTypes('standalone', 'bool');
    }
}

