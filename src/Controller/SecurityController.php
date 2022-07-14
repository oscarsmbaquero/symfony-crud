<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    
    //funcion para introducir a fuego un usuario, funciona, pero la comento una vez probada

    // #[Route(path: '/insert/user', name: 'app_signup')]
    // public function createUser(EntityManagerInterface $doctrine , UserPasswordHasherInterface $hasher):Response
    // {
    //     $user1 = new User();
    //     $user1->setUserName('Otto');
    //     $user1->setPassword($hasher->hashPassword($user1,'0810'));
    //     $user1->setName('Otto');
    //     $user1->setRoles(['ROLE_ADMIN']);

    //     $doctrine->persist($user1);
    //     $doctrine->flush();

    //     return new Response('Usuario creado ok ');
        
    // }

    #[Route("/new/user", name:"createuser")]
    public function newUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher){
     
        $form=$this->createForm(UserType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));
            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash('success','Usuario insertado correctamente');
            return $this->redirectToRoute('getAlbums');
            
        }
        return $this->renderForm("extremoduro/newUser.html.twig",['userForm'=> $form]);
      
    }
}
