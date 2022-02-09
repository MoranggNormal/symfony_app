<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserData extends AbstractController
{
    /**
     * @Route("/user/all-users")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function filterAllUsers(UserRepository $userRepository): Response
    {
        $result = $userRepository->findAllUsers();
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($result, 'json');

        return new Response(
            $data
        );
    }

    /**
     * @Route("/user/email={userEmail}")
     * @param UserRepository $userRepository
     * @param string $userEmail
     * @return Response
     */
    public function filterByEMail(UserRepository $userRepository, string $userEmail): Response
    {
        $result = $userRepository->filterEmail($userEmail);
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
            '<html lang="pt-Br"><body>User has been created.</body></html>'
        );
    }
}
