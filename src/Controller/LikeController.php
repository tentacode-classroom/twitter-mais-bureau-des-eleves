<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    /**
     * @Route("/like/{tweetId}", name="like")
     */
    public function index(int $tweetId, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $message = $this->getDoctrine()->getRepository(Message::class) ->find($tweetId);
        $like = new Likes();
        $like->setUser($user);
        $like->setMessage($message);
        $update_user = $em->getRepository(User::class)->find($user);
        $update_user->increementLike();
        $entityManager->persist($like);
        $entityManager->flush();

        $previousUrl = $request->server->get('HTTP_REFERER');
        return $this->redirect($previousUrl);
    }

    /**
     * @Route("/unlike/{tweetId}", name="unlike_tweet")
     */
    public function unlikeMessage(Message $tweetId, Request $request)
    {
        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $update_user = $entityManager->getRepository(User::class)->find($user);
        $update_user->decreementLike();

        $entityManager->persist($update_user);
        $entityManager->flush();


        $queryBuilder->delete(Likes::class, 'l')
            ->andWhere('l.user = :user')
            ->setParameter(':user', $user)
            ->andWhere('l.message = :message')
            ->setParameter(':message', $tweetId);
        $query = $queryBuilder->getQuery();
        $query->execute();

        $previousUrl = $request->server->get('HTTP_REFERER');
        return $this->redirect($previousUrl);
    }
}
