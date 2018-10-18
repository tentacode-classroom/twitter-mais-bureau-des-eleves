<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Expr\New_;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $neerfix = New User();
        $neerfix->setEmail('nicolas.notararigo@ynov.com');
        $neerfix->setFirstname('Nicolas');
        $neerfix->setLastname('Notararigo');
        $neerfix->setPassword('$2y$12$pd5eJIjiFOeDmH1Zaxbl6OVxUBq0MuvYWd9YcH8tiNO0vjTNRsMUa');
        $neerfix->setPromotion('B2');
        $neerfix->setTraining('Ingésup');
        $neerfix->setUsername('Neerfix');

        $manager->persist($neerfix);

        $Le_Paresseux = New User();
        $Le_Paresseux->setEmail('Alexandre.gelin@ynov.com');
        $Le_Paresseux->setFirstname('Alexandre');
        $Le_Paresseux->setLastname('Gelin');
        $Le_Paresseux->setPassword('$2y$12$pd5eJIjiFOeDmH1Zaxbl6OVxUBq0MuvYWd9YcH8tiNO0vjTNRsMUa');
        $Le_Paresseux->setPromotion('B2');
        $Le_Paresseux->setTraining('Ingésup');
        $Le_Paresseux->setUsername('Le_Paresseux');

        $manager->persist($Le_Paresseux);

        $Licorne_Electronique = New User();
        $Licorne_Electronique->setEmail('Jade.rosa@ynov.com');
        $Licorne_Electronique->setFirstname('Jade');
        $Licorne_Electronique->setLastname('Rosa');
        $Licorne_Electronique->setPassword('$2y$12$pd5eJIjiFOeDmH1Zaxbl6OVxUBq0MuvYWd9YcH8tiNO0vjTNRsMUa');
        $Licorne_Electronique->setPromotion('B2');
        $Licorne_Electronique->setTraining('Ingésup');
        $Licorne_Electronique->setUsername('Licorne_Electronique');

        $manager->persist($Le_Paresseux);

        $manager->flush();

    }
}