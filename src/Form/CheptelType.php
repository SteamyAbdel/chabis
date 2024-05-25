<?php

namespace App\Form;

use App\Entity\Cheptel;
use App\Entity\Production;
use App\Entity\Ration;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheptelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomCheptel')
            ->add('dateCreation')
            ->add('commentaire')
            /*->add('productions',EntityType::class,[
                'class' => Production::class,
                'label' => 'Productions',
            ])*/
            ->add('ration',EntityType::class,[
                'class' => Ration::class,
                'label' => 'Rations'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheptel::class,
        ]);
    }


}
