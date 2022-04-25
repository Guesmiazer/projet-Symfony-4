<?php

namespace App\Repository;

use App\Entity\Reclamation;
use App\Data\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;



/**
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
        
    }

   /* public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM AppBundle:Article e
                WHERE e.Titre LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
**/

    /**
     * Récupère les produits en lien avec une recherche
     * @return Reclamation[]     
     */
    public function findSearch(SearchData $search):array
    {
        $query = $this
        ->createQueryBuilder('p')
        ->select('p');
        

    if (!empty($search->q)) {
        $query = $query
            ->andWhere('p.type LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }
      return $query->getQuery()->getResult(); 
    }



    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}