<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */

    public function findAllUsers()
    {
        return $this->createQueryBuilder('u')
            ->select('u.id, u.name, u.email, u.phone, u.birthDate, u.cpf')
            ->orderBy('u.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return the last created user
    //  */
    public function getLastCreatedUser()
    {
        return $this->createQueryBuilder('u')
            ->select('u.id, u.name, u.email, u.phone, u.birthDate, u.cpf')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return user email
    //  */

    public function filterEmail($param)
    {

        return $this->createQueryBuilder('u')
            ->select('u.email')
            ->andWhere('u.email = :email')
            ->setParameter('email', $param)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
