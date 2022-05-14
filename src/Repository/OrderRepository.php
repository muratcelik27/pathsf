<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function add(Order $order)
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();

        return $order;
    }

    public function findOneByIdJoinedToUserAndProduct(int $orderId): ?Order
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o, u, p
            FROM App\Entity\Order o
            LEFT JOIN o.user u
            LEFT JOIN o.product p
            WHERE o.id = :id'
        )->setParameter('id', $orderId);

      //echo($query->getSQL()); exit;

        return $query->getOneOrNullResult();
    }
}