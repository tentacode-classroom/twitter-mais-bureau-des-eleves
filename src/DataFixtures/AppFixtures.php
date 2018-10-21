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
        $neerfix->setAvatar('https://media.licdn.com/dms/image/C4D03AQFwiDq9lp0p7Q/profile-displayphoto-shrink_100_100/0?e=1545264000&v=beta&t=vV0Qgliqyf-oRknMtojgmsI4PncvRbV3kwRdArqkJNY');
        $neerfix->setPromotion('B2');
        $neerfix->setTraining('Ingésup');
        $neerfix->setUsername('Neerfix');
        $neerfix->setBDE("1");

        $manager->persist($neerfix);

        $Le_Paresseux = New User();
        $Le_Paresseux->setEmail('Alexandre.gelin@ynov.com');
        $Le_Paresseux->setFirstname('Alexandre');
        $Le_Paresseux->setLastname('Gelin');
        $Le_Paresseux->setAvatar('http://www.dinosauria.org/blog/wp-content/uploads/2016/06/Figure_5.jpg');
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

        $manager->persist($Licorne_Electronique);

        $El_monkey = New User();
        $El_monkey->setEmail('julien.bonnanfant@ynov.com');
        $El_monkey->setFirstname('Julien');
        $El_monkey->setLastname('Bonnanfant');
        $El_monkey->setAvatar('http://s1.lprs1.fr/images/2017/09/16/7264584_1-0-124924437.jpg');
        $El_monkey->setPassword('$2y$12$pd5eJIjiFOeDmH1Zaxbl6OVxUBq0MuvYWd9YcH8tiNO0vjTNRsMUa');
        $El_monkey->setPromotion('B2');
        $El_monkey->setTraining('Ingésup');
        $El_monkey->setUsername('El_Monkey');

        $manager->persist($El_monkey);

        $B2oba = New User();
        $B2oba->setEmail('Anthony.Dubuis@ynov.com');
        $B2oba->setFirstname('Anthony');
        $B2oba->setLastname('Dubuis');
        $B2oba->setPassword('$2y$12$pd5eJIjiFOeDmH1Zaxbl6OVxUBq0MuvYWd9YcH8tiNO0vjTNRsMUa');
        $B2oba->setPromotion('B2');
        $B2oba->setTraining('Ingésup');
        $B2oba->setUsername('B2oba');

        $manager->persist($B2oba);

        $manager->flush();

    }
}