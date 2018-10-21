<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController
{
//   public function new(Request $request)
//    {
//        $user = new User();
//
//        $form = $this->createFormBuilder($user)
//            ->add('user', TextType::class)
//            ->add('Rechercher', SubmitType::class)
//            ->getForm();
//
//        $form->handleRequest($request);
//
//        if($form->isSubmitted() && $form-isValid()){
//            $user = $form->getData();
//
//            return $this->redirectToRoute('user-success');
//        }
//    }

//    public function show()
//    {
//        $user = new user();
//        $user->setUsername($this->getUser());
//        $form = $this->createForm(TweetType::class, $user, [
//            'actionUrl' => $this->generateUrl('search_user')
//        ]);
//
//        return $this->render('search/search.html.twig', [
//            'form' => $form->createView(),
//        ]);
//
//    }

    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request)
    {
        //$users = new User();
        $formSearch = $this->createForm(User::class);
        $formSearch->handleRequest($request);
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $userSearch = $formSearch->getData();
            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findUsersByUsername($userSearch['username']);
            return $this->render('Search/search.html.twig', array(
                'users' => $users,
                'formSearch' => $formSearch->createView(),
            ));
        } else {
            return $this->render('Search/search.html.twig', array(
                'formSearch' => $formSearch->createView(),
            ));
        }
    }
}
