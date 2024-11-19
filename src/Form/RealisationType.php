<?php
// src/Form/RealisationType.php

namespace App\Form;

use App\Entity\Realisation;
use App\Entity\DetailsRealisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_projet', TextType::class, [
                'label' => 'Nom du projet',
            ])
            ->add('numero_projet', TextType::class, [
                'label' => 'Numéro du projet',
            ])
            ->add('image_pricipale', FileType::class, [
                'label' => 'Image principale',
                'required' => true,
            ])
            ->add('detailsRealisations', FileType::class, [
                'label' => 'Images de détails',
                'mapped' => false,  // Ce champ n'est pas mappé directement à l'entité Realisation
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
