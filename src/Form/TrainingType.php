<?php

namespace App\Form;

use DateTime;
use App\Entity\User;
use App\Entity\Exercice;
use App\Entity\Training;
use App\Repository\ExerciceRepository;
use App\Repository\TrainingRepository;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class TrainingType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
       $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->token->getToken()->getUser();
        // dd($user);
        $builder
            ->add('date_training', DateType::class, [
                'required' => false,
                'empty_data' => (new \Datetime('now'))->format('d-m-Y')
            ])
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'name',
                'multiple' => true,
              
                
            ])
            ->add('is_realized', ChoiceType::class, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
