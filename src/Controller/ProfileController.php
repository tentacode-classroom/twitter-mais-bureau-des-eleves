<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;

class ProfileController extends AbstractController
{
    /**
     * @Route("/p/{userUsername}", name="user_details")
     */
    public function index(String $userUsername)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByUsername($userUsername);

        $data = [
            'slug' => $userUsername,
            'user' => $user,
        ];

        return $this->render('profile/index.html.twig', $data);
    }
}