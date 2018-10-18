<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Expr\New_;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $neerfix = New User();
        $neerfix->setEmail('nicolas.notararigo@ynov.com');
        $neerfix->setFirstname('Nicolas');
        $neerfix->setLastname("Notararigo");
        $neerfix->setPassword("azertyuiop");
        $neerfix->setPromotion("B2");
        $neerfix->setTraining("Ingésup");
        $neerfix->setUsername("Neerfix");

        $manager->persist($neerfix);

        $Le_Paresseux = New User();
        $Le_Paresseux->setEmail('Alexandre.gelin@ynov.com');
        $Le_Paresseux->setFirstname('Alexandre');
        $Le_Paresseux->setLastname("Gelin");
        $Le_Paresseux->setPassword("azertyuiop");
        $Le_Paresseux->setPromotion("B2");
        $Le_Paresseux->setTraining("Ingésup");
        $Le_Paresseux->setUsername("Le_Paresseux");

        $manager->persist($Le_Paresseux);

        $Licorne_Electronique = New User();
        $Licorne_Electronique->setEmail('Jade.rosa@ynov.com');
        $Licorne_Electronique->setFirstname('Jade');
        $Licorne_Electronique->setLastname("Rosa");
        $Licorne_Electronique->setPassword("azertyuiop");
        $Licorne_Electronique->setPromotion("B2");
        $Licorne_Electronique->setTraining("Ingésup");
        $Licorne_Electronique->setUsername("Licorne_Electronique");

        $manager->persist($Le_Paresseux);

        $tweet1 = New Message();
        $tweet1->setContent("Mon premier tweet !! YES");
        $tweet1->setIsActive("true");
        $tweet1->setDateTime("2018/10/18 10:07:00");
        $tweet1->setUser("1");

        $manager->persist($tweet1);

        $tweet2 = New Message();
        $tweet2->setContent("Mon deuxième tweet !! YES");
        $tweet2->setIsActive("true");
        $tweet2->setDateTime("2018/10/18 10:40:00");
        $tweet2->setUser("2");

        $manager->persist($tweet2);

        $tweet3 = New Message();
        $tweet3->setContent("J'aime les licornes :p");
        $tweet3->setIsActive("true");
        $tweet3->setDateTime("2018/10/18 11:03:00");
        $tweet3->setUser("3");

        $manager->persist($tweet3);

        $tweet4 = New Message();
        $tweet4->setContent("J'adooooooore les sushis :) ");
        $tweet4->setIsActive("true");
        $tweet4->setDateTime("2018/10/18 12:07:00");
        $tweet4->setUser("1");

        $manager->persist($tweet4);

        $tweet5 = New Message();
        $tweet5->setContent("J'aI faim ... ");
        $tweet5->setIsActive("true");
        $tweet5->setDateTime("2018/10/18 12:10:00");
        $tweet5->setUser("1");

        $manager->persist($tweet5);

        $manager->flush();

    }
}