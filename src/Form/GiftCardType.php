<?php

namespace App\Form;
use App\Entity\Merchant;
use App\Entity\GiftCard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiftCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('amount')
            ->add('expirydate', null, [
                'widget' => 'single_text',
            ])
            ->add('merchant', EntityType::class, [
                'class' => Merchant::class,
                'choice_label' => 'name',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiftCard::class,
        ]);
    }
}
