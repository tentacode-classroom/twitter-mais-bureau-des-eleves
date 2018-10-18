<?php
namespace App\Controller;
use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TweetType;
use Symfony\Component\HttpFoundation\Request;
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {

        $tweet = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy([], ['dateTime' => 'ASC']);

        return $this->render('home_page/index.html.twig', [

            'tweets' => $tweet,
        ]);
    }
}