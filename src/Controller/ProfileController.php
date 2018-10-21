<?php
namespace App\Controller;
use App\Entity\Follow;
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

            $currentUser = $this->getUser();

        $relation = [];

        if ($currentUser)
        {
            $relation = $this->getDoctrine()->getRepository(Follow::class)
                ->findOneBy([
                    'follower' =>$currentUser,
                    'followed' => $user
                ]);
        }

        $isFollowing = false;

        if($relation)
        {
            $isFollowing = true;
        }
        else{
            $isFollowing = false;
        }

        $tweet = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy(['user' => $user], [
                'dateTime' => 'DESC'
            ]);

        $likes = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findBy(['user' => $user],['dateTime' => 'DESC']);

        $Followers = $this->getDoctrine()
            ->getRepository(Follow::class)
            ->findBy(['followed' => $user]);
        $nbFollowers = count($Followers);

        $Follows = $this->getDoctrine()
            ->getRepository(Follow::class)
            ->findBy([
                'followed' => $user
            ]);
        $nbFollows = count($Follows);

        $data = [
            'tweets' => $tweet,
            'slug' => $userUsername,
            'user' => $user,
            'current_user' => $currentUser,
            'isFollowing' => $isFollowing,
            'nb_followers' => $nbFollowers,
            'nb_follows' => $nbFollows,
            'likes' => $likes,
        ];



        return $this->render('profile/index.html.twig', $data);
    }

    /**
     * @Route("/follow/{id}", name="follow")
     */
    public function follow(int $id) {
        $followIt = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy([
                'id' => $id
            ]);
        $follow = new Follow();
        $follow->setFollower($this->getUser());
        $follow->setFollowed($followIt);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($follow);
        $entityManager->flush();
        return $this->redirectToRoute('user_details', ['userUsername' => $followIt->getUsername()]);
    }

    /**
     * @Route("/unfollow/{id}", name="unfollow")
     */
    public function unsubscribe(int $id) {
        $unfollowIt = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy([
                'id' => $id
            ]);
        $friendsRowToDelete = $this->getDoctrine()->getRepository(Follow::class)
            ->findOneBy([
                'follower' => $this->getUser(),
                'followed' => $unfollowIt
            ]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($friendsRowToDelete);
        $entityManager->flush();
        return $this->redirectToRoute('user_details', ['userUsername' => $unfollowIt->getUsername()]);
    }
}
