<?php

namespace App\Form;

use App\Entity\Traitement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraitementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomTraitement')
            ->add('numTraitement')
            ->add('debutTraitement')
            ->add('finTraitement')
            ->add('raisonTraitement')
            ->add('dateAchatTraitement')
            ->add('dureeQuantiteeEnJour')
            ->add('commentaire')
            ->add('dateVisiteVeterinaire')
            ->add('raisonVisiteVeterinaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Traitement::class,
        ]);
    }
}
