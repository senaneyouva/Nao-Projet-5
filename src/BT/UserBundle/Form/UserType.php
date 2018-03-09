<?php

namespace BT\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
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
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs mot de passe doivent être identique.',
                'first_options' => ['label' =>'Veuillez taper votre mot de passe'],
                'second_options' => ['label' =>'Répétez votre mot de passe']
            ])
            ->add('naturaliste', CheckboxType::class, [
                'required' => false,
                'attr' =>  [
                'class' => 'checkbox' ]
                ])

            ->add('save', SubmitType::class, [
                'attr' => [
                    'label' => 'Valider les informations'
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
