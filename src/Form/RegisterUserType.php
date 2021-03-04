<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=>'Saisir le prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Saisir le nom'
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=>'Email',
                'attr'=>[
                    'placeholder'=>'Saisir le email'
                ]
            ])
            ->add('roles', ChoiceType::class,[
                             'choices' =>[

                                 'Administrateur'=> "ROLE_ADMIN",
                                 'Formateur'=> "ROLE_TEACHER",
                                 'Etudiant'=> "ROLE_STUDENT"
                                 ],
                            'multiple'=> true,
                            'expanded'=> false,
                            'label'=> "Roles"


            ])
            ->add('password', RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de pass et la confirmation doivent être identique.',
                'label'=>'Mot de passe',
                'required'=> true,
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Confirmer le mot de passe']

            ])

            ->add('submit', SubmitType::class,[
                'label'=>'Inscrire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
