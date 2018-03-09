<?php

namespace BT\NaoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-contact',

             ],
                'constraints' => array(
                    new NotBlank(),
                    new Email(),
                )
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-contact',
                    'label' => 'Nom'
                ],
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                )
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-contact'
                ],
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                )
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Votre message....',
                    'class' => 'form-contact form-textarea'
                ],
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                )
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                  'class' => 'btn-green btn-middle',
                    'label' => 'Soumettre'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contact_form';
    }


}
