<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use App\Entity\Branch;

class CompanyType extends AbstractType
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
            ->add('telephone', null, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('logo', FileType::class, [
                'label' => 'Logo de l\'entreprise',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'L\'image n\'est pas valide (format accepté : png or jpg)',
                    ])
                ]
            ])
            ->add('nomDeLaRue', null, [
                'label' => 'Rue',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('sector', null, [
                'label' => 'Secteur géographique d\'intervention',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('branch', EntityType::class, [
                'class' => Branch::class,
                'choice_label' => 'name',
                'label' => 'secteur d\'activité',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('branchDetail', null, [
                'label' => 'Objet de la structure',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('description', null, [
                'label' => 'Comment votre société contribue-t-elle ou imaginez-vous qu’elle puisse contribuer ?',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('sector', null, [
                'label' => 'Quel est votre périmètre géographique d’intervention ?',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('postalCode', null, [
                'label' => 'Code postal',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('country', null, [
                'label' => 'Pays',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('emailContact', null, [
                'label' => 'Adresse mail de contact',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('complementaryInformations', null, [
                'label' => 'Informations complémentaires',
                'attr' => ['class' => 'form-control'],
                'row_attr' => [
                    'class' => 'form-group'
                ]
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Mettre à jour les informations',
                'attr' => [
                    'class' => 'btn btn-success waves-effect waves-light'
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
