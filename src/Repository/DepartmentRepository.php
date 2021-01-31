<?php

namespace App\Repository;

use App\Entity\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Department::class);
    }

    public function getDepartmentRegisteredStudents(int $departmentId)
    {
        return $this->createQueryBuilder('d')
            ->select('s.firstName, s.lastName, s.numEtud')
            ->innerJoin('App\Entity\Student', 's', Join::WITH, 's.department = d.id')
            ->where('d.id = :departmentId')
            ->setParameter('departmentId', $departmentId)
            ->getQuery()
            ->getResult();
    }
}
