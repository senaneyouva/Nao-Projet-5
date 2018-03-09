<?php

namespace BT\NaoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'html5' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker',
                'placeholder' => 'Date',
                'label' => 'Date et heure'
                ]
            ])
            ->add('latitude', null, [
                'attr' => [
                    'class' => 'latitude',
                    'label' => 'Latitude'
                ]
            ])
            ->add('longitude', null, [
                'attr' => [
                    'class' => 'longitude',
                    'label' => 'longitude'
                ]
            ])
            ->add('content', null, [
                'attr' => [
                    'placeholder' => 'Veuillez saisir une description',
                    'label' => 'Description',
                    'class' => 'content-area'
                ]
            ])
            ->add('observationFile', FileType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'inputfile inputfile-2'
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'label' => 'Valider',
                    'class' => 'btn btn-success btn-green'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BT\NaoBundle\Entity\Observation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bt_naobundle_observation';
    }


}
