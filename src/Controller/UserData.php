<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserData extends AbstractController
{

    /** 
     * @Route("/user/all-users")
     */
    public function filterAllUsers(): Response
    {
        $getData = $this->getDoctrine()->getRepository(User::class);
        $result = $getData->findAllUsers();
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json');

        return new Response(
            $data
        );
    }

    /** 
     * @Route("/user/email={userEmail}")
     */
    public function filterByEMail(string $userEmail): Response
    {
        $getData = $this->getDoctrine()->getRepository(User::class);
        $result = $getData->filterEmail($userEmail);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json');

        return new Response(
            $data
        );
    }

    /**
     * @Route("/user/create-user/name={name}&phone={phone}&birthDate={birthDate}&email={email}&password={password}&cpf={cpf}")
     */
    public function data(string $name, string $phone, string $birthDate, string $email, string $password, string $cpf): Response
    {
        $user = new User();
        $user->setName($name);
        $user->setPhone($phone);
        $user->setBirthDate($birthDate);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCpf($cpf);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response(
            '<html><body>User has been created.</body></html>'
        );
    }
}
