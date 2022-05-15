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

    public function findAllByIdJoinedToProduct(int $userId)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT o, p, u
            FROM App\Entity\Order o
            INNER JOIN o.product p
            INNER JOIN o.user u
            WHERE o.user =:p1'
        )->setParameter('p1',$userId);

        return $query->getArrayResult();
    }


    public function findOneByIdJoined(int $orderId, int $userId)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT o, p, u
            FROM App\Entity\Order o
            INNER JOIN o.product p
            INNER JOIN o.user u
            WHERE o.id = :p1 and o.user =:p2'
        )->setParameter('p1', $orderId)->setParameter('p2',$userId);

        return $query->getSingleResult();
    }
}