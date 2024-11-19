<?php

namespace App\Form;

use App\Entity\DetailsRealisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsRealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Image',
                'mapped' => false, // Ce champ ne sera pas mappé à l'entité directement
                'required' => false,
                'data_class' => null, // Empêche Symfony de chercher une entité associée
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailsRealisation::class,
        ]);
    }
}
