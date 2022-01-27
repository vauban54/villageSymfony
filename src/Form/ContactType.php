<?php

namespace App\Form;

use App\Entity\Civilite;
use App\Entity\Contact;
use App\Entity\Motif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('eMail')
            ->add('content')
            ->add('civilite', EntityType::class, [
                'class' => Civilite::class,
                'choice_label' => 'genre'
                // 'attr' => ['class' => 'tinymce']
            ])
            ->add('motif', EntityType::class, [
                'class' => Motif::class,
                'choice_label' => 'title'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
