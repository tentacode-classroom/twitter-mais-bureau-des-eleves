<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class LikeController extends AbstractController
{
    /**
     * @Route("/like/{tweetId}", name="like")
     */
    public function index(int $tweetId, UserInterface $user)
    {
        $manager = $this->getDoctrine()->getManager();
        $like = $this->getDoctrine()->getRepository(Like::class)
            ->findOneLike($user->getId(), $tweetId);
        $liker = $user;
        $tweet = $this->getDoctrine()->getRepository( Message::class )
            ->find( $tweetId );
        if (count($like) < 1) {
            $newLike = new Like();
            $newLike->setMessage( $tweet );
            $newLike->setUser( $user );
            $manager->persist($newLike);
            $manager->flush();
            return new Response('Like', 200 );
        } else {
            $manager->remove( $like[0] );
            $manager->flush();
            return new Response('UnLike', 200 );
        }
    }
}
