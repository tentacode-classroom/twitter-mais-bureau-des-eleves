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
    public function index(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(TweetType::class, $message);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();
        };

        $tweet = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy([], ['dateTime' => 'DESC']);
        if (!$tweet){
            throw $this->createNotFoundException('There is no product in the database');
        }

        return $this->render('home_page/index.html.twig', [
            'form' => $form->createView(),
            'tweets' => $tweet,
        ]);
    }
}