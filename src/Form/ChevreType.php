<?php

namespace App\Form;

use App\Entity\Chevre;
use App\Entity\GroupeTraitement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChevreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matriculeChevre')
            ->add('ancienMatricule')
            ->add('sexeChevre')
            ->add('raceChevre')
            ->add('dateArrivee')
            ->add('dateNaissance')
            ->add('commentaire')
            ->add('cheptel')
            ->add('pays')
            ->add('groupetraitements')
            ->add('societe')
            ->add('vente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chevre::class,
        ]);
    }
}
