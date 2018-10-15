<?php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class)

            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe'
            ])
            ->add('promotion', ChoiceType::class, array(
                'choices'  => array(
                    'B1' => "b1",
                    'B2' => "b2",
                    'B3' => "b3",
                    'M1' => "m1",
                    'M2' => "m2",
                ),
            ))
            ->add('training', ChoiceType::class, array(
                'choices'  => array(
                    'Audiovisuel' => "audiovisuel",
                    'Ingesup' => "ingesup",
                    'Manaa' => "Manaa",
                    'Digital Business School' => "dbs",
                    'Web Com et Graphic Design' => "wcgd",
                    'Animation 3D Jeux Vidéos' => "a3djv",
                    'Lim\'Art' => "limart",
                ),
            ))
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}