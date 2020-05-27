<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use App\Entity\Branch;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CompanyRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('name', null, [
                'label' => 'Nom de la structure',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            // ->add('email', EmailType::class, [
            //     'label' => 'Email de l\'entreprise',
            //     'attr' => ['class' => 'form-control'],
            // ])
            // ->add('plainPassword', RepeatedType::class, [
            //     'type' => PasswordType::class,
            //     'invalid_message' => 'Vous devez renseigner un mot de passe valide et le confirmer dans le champ suivant.',
            //     'mapped' => false,
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Veuillez renseigner un mot de passe',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            //     'first_options'  => [
            //         'label' => 'Mot de passe',
            //         'attr' => ['class' => 'form-control'],
            //         'row_attr' => [
            //             'class' => 'form-group'
            //         ]
            //     ],
            //     'second_options' => [
            //         'label' => 'Confirmation du mot de passe',
            //         'attr' => ['class' => 'form-control'],
            //         'row_attr' => [
            //             'class' => 'form-group'
            //         ]
            //     ],
                
            // ])
            // ->add('branch', EntityType::class, [
            //     'class' => Branch::class,
            //     'choice_label' => 'name',
            //     'label' => 'secteur d\'activité',
            //     'attr' => ['class' => 'form-control'],
            //     'row_attr' => [
            //         'class' => 'form-group'
            //     ]
            // ])
            // ->add('description', TextareaType::class, [
            //     'attr' => ['class' => 'form-control'],
            //     'required' => false,
            //     'row_attr' => [
            //         'class' => 'form-group'
            //     ]
            // ])
            ->add('contribution', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Nom de la rue',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            // ->add('logoFile', VichImageType::class, [
            //     'label' => 'logo',
            //     'required' => false,
            //     'attr' => ['class' => 'form-control'],
            // ])
            ->add('add', SubmitType::class, [
                'label' => 'Créer le compte',
                'attr' => [
                    'class' => 'btn waves-effect btn-success waves-light'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
