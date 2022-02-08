<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserData extends AbstractController
{
    /**
     * @Route("/user/{name}/{email}")
     */
    public function data(string $name, string $email): Response
    {
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
       

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response(
            '<html><body>Lucky number:</body></html>'
        );
    }

    /** 
     * @Route("/users")
     */
    public function listUsers(): Response
    {
        
        $users = $this->getDoctrine()->getRepository(User::class);

        $userList = $users->findAll();

        $serializer = $this->get('serializer');
        $data = $serializer->serialize($userList, 'json');


        return new Response(
            $data
        );
    }


    /** 
     * @Route("/users/{userName}")
     */
    public function filterUser($userName): Response
    {
        
        $users = $this->getDoctrine()->getRepository(User::class);

        $userList = $users->findAll();

        $serializer = $this->get('serializer');
        $data = $serializer->serialize($userList, 'json');


        return new Response(
            $data
        );
    }
}
