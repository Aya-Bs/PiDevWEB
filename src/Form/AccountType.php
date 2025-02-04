<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Positive;



class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nameAccount', TextType::class)
        ->add('typeAccount', ChoiceType::class, [
            'choices' => [
                'Checking' => 'CHECKING',
                'Savings' => 'SAVINGS',
                'Credit Card' => 'CREDIT_CARD',
                'Cash' => 'CASH',
            ],
        ])
        ->add('balance', NumberType::class, [
            'constraints' => [
                new GreaterThan([
                    'value' => 0,
                    'message' => 'Balance must be greater than zero.',
                ]),
                new Positive([
                    'message' => 'Balance must be a positive number.',
                ]),
            ],
        ])
        ->add('description', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
