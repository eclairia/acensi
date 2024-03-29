<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Student;
use App\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'empty_data' => ''
            ])
            ->add('lastName', TextType::class, [
                'empty_data' => ''
            ])
            ->add('numEtud', TextType::class, [
                'empty_data' => ''
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
