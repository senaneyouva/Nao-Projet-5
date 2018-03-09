<?php

namespace BT\UserBundle\Form;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'attr' => [
                    'placeholder' => 'Identifiant',
                    'label' => 'Identifiant'
                ]
            ])
            ->add('email', null, [
                'attr' => [
                    'placeholder' => 'exemple@email.fr'
                ]
            ])
            ->add('firstname', null, [
                'attr' => [
                    'placeholder' => 'ex : Aleck'
                ]
            ])
            ->add('lastname', null, [
                'attr' => [
                    'placeholder' => 'ex : Vincent'
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'label' => 'Vaalider les informations'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BT\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bt_userbundle_user';
    }


}
