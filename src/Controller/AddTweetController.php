<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TweetType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Message;

class AddTweetController extends AbstractController
{
    /**
     * @Route("/add/tweet", name="add_tweet")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $message = new Message();
        $message->setUser($this->getUser());
        $user = $this->getUser();
        $form = $this->createForm(TweetType::class, $message);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        $update_user = $em->getRepository(User::class)->find($user);
        $update_user->increementTweet();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();
        };


        return $this->redirectToRoute('homepage');


    }

    public function show()
    {
        $message = new Message();
        $message->setUser($this->getUser());
        $form = $this->createForm(TweetType::class, $message, [
            'actionUrl' => $this->generateUrl('add_tweet')
        ]);

        return $this->render('add_tweet/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
