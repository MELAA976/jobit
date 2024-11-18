<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Candidat' => 'ROLE_CANDIDAT',
                    'Recruteur' => 'ROLE_RECRUTEUR',
                    'Partenaire' => 'ROLE_PARTENAIRE',
                ],
                'multiple' => true,
                'required' => true,
                'label' => 'Choisissez votre rôle',
            ])

            ->add('nom')
            ->addDependent('prenom', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles) || $roles && in_array('ROLE_RECRUTEUR', $roles)) {
                    $field->add(TextType::class);
                }
            })->addDependent('date_naissance', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles) || $roles && in_array('ROLE_RECRUTEUR', $roles)) {
                    $field->add(DateType::class, [
                        'widget' => 'single_text',
                        // this is actually the default format for single_text
                        'format' => 'yyyy-MM-dd',
                        'html5' => true,
                        'required' => false
                    ]);
                }
            })


            ->addDependent('adresse', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles)) {
                    $field->add(TextType::class);
                }
            })->add('email')


            ->addDependent('telephone', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles)) {
                    $field->add(TextType::class, [
                        'constraints' => [new Length([
                            'max' => 20,

                        ])]



                    ]);
                }
            })
            ->addDependent('photo', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles) || $roles && in_array('ROLE_RECRUTEUR', $roles)) {
                    $field->add(
                        FileType::class,
                        [
                            'required' => false,
                            'constraints' => [
                                new File([
                                    //'maxSize' => '1024k',
                                    'mimeTypes' => [
                                        'image/*' //format accepter
                                    ],
                                    'mimeTypesMessage' => 'telecharger une image valide', //message de non conformiter de type de fichier
                                ])
                            ]

                        ]
                    );
                }
            })->addDependent('logo', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_PARTENAIRE', $roles)) {
                    $field->add(
                        FileType::class,
                        [
                            'required' => false,
                            'constraints' => [
                                new File([
                                    //'maxSize' => '1024k',
                                    'mimeTypes' => [
                                        'image/*'
                                    ],
                                    'mimeTypesMessage' => 'telecharger une image valide',
                                ])
                            ]

                        ]
                    );
                }
            })



            ->addDependent('presentation', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_CANDIDAT', $roles)) {
                    $field->add(TextType::class);
                }
            })

            ->addDependent('site_web', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_PARTENAIRE', $roles)) {
                    $field->add(TextType::class);
                }
            })





            ->add('site_web')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'always_empty' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])


            ->addDependent('entreprise', 'roles', function (DependentField $field, ?array $roles) {
                if ($roles && in_array('ROLE_RECRUTEUR', $roles)) {
                    $field->add(EntityType::class, [
                        'class' => Entreprise::class,
                        'choice_label' => 'nom',
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
