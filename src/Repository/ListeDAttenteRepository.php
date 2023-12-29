<?php

namespace App\Repository;

use App\Entity\ListeDAttente;
use App\Entity\SearchConvertis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<ListeDAttente>
 *
 * @method ListeDAttente|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeDAttente|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeDAttente[]    findAll()
 * @method ListeDAttente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeDAttenteRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, ListeDAttente::class);

        $this->paginator = $paginator;
    }

    public function save(ListeDAttente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Recupère les utilisateurs en lien avec une recherche
     * @return PaginationInterface
     */
    public function findSearch(SearchConvertis $search): PaginationInterface
    {
        $query = $this->getSearcheQuery($search)->getQuery();

        return $this->paginator->paginate(
            $query,
            $search->page,
            20
        );
    }

    /**
     * //@return QueryBuilder
     */
    private function getSearcheQuery(SearchConvertis $search) //: QueryBuilder
    {
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->orderBy('c.created', 'DESC');

        if (!empty($search->getInstagram())) {
            $query = $query
                ->andWhere('c.instagram LIKE :instagram')
                ->orWhere('c.numero LIKE :numero')
                ->setParameters([
                    'instagram' => "%{$search->getInstagram()}%",
                    'numero' => "%{$search->getInstagram()}%",
                ]);
        }

        if (!empty($search->getMinDate())) {
            $query = $query
                ->andWhere('c.created >= :from')
                ->setParameter('from', $search->getMinDate());
        }

        if (!empty($search->getMaxDate())) {
            $query = $query
                ->andWhere('c.created <= :to')
                ->setParameter('to', $search->getMaxDate());
        }

        return $query;
    }

    public function remove(ListeDAttente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ListeDAttente[] Returns an array of ListeDAttente objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListeDAttente
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
