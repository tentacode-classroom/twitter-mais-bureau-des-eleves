<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Message;

class ProfileController extends AbstractController
{
    /**
     * @Route("/p/{userUsername}", name="user_details")
     */
    public function index(String $userUsername)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername($userUsername);

        $tweet = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy(['user' => $user], ['dateTime' => 'DESC']);

        $data = [
            'tweets' => $tweet,
            'slug' => $userUsername,
            'user' => $user,
        ];

        return $this->render('profile/index.html.twig', $data);
    }
}