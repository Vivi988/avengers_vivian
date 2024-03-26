<?php

namespace App\Form\Type;

use App\Entity\Employe;
use App\Entity\Adresse; // Assurez-vous d'importer l'entité Adresse si vous souhaitez l'utiliser avec EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Correction de l'importation pour TextType
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class)
            ->add('Prenom', TextType::class)
            ->add('Poste', TextType::class)
            ->add('Adresse', EntityType::class, [
                'class' => Adresse::class, // Utilisez Adresse::class ici
                'choice_label' => function (Adresse $adresse) {
                    // Ajustez cette partie selon les propriétés de votre entité Adresse
                    return $adresse->getAdresse(); // Exemple: retourne la rue de l'adresse
                },
                'placeholder' => 'Choisir une adresse', // Assurez-vous que ceci est logique pour votre cas d'utilisation
            ])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
