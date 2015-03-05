<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use Metinet\AppBundle\Entity\Fact;
use Metinet\AppBundle\Entity\FactStatus;

class DoctrineFactRepository implements FactRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll()
    {
        return $this->entityManager->getRepository("MetinetAppBundle:Fact")->findAll();
    }

    public function findById($id)
    {
        return $this->entityManager->find("MetinetAppBundle:Fact", $id);
    }

    public function findAccepted()
    {
        $queryBuilder = $this->getQueryBuilderByStatus();
        $queryBuilder->setParameter("status", FactStatus::ACCEPTED);

        return $queryBuilder->getQuery()->getResult();
    }

    public function findPending()
    {
        $queryBuilder = $this->getQueryBuilderByStatus();
        $queryBuilder->setParameter("status", FactStatus::PENDING);

        return $queryBuilder->getQuery()->getResult();
    }

    public function pickRandom()
    {
        $connection = $this->entityManager->getConnection();
        $ids = $connection->fetchAll("SELECT id FROM fact;");
        $randomId = $ids[array_rand($ids)]["id"];

        $query = $this->entityManager->createQuery(
            "SELECT fact FROM MetinetAppBundle:Fact fact WHERE fact.id = :randomId")
        ;

        $query->setParameter("randomId", $randomId);

        $results = $query->getSingleResult();

        return $results;
    }

    public function save(Fact $fact)
    {
        $this->entityManager->persist($fact);
        $this->entityManager->flush();
    }

    private function getQueryBuilderByStatus()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select("fact")
            ->from("MetinetAppBundle:Fact", "fact")
            ->where(
                $queryBuilder->expr()->like(
                    "fact.status",
                    ":status"
                )
            );

        return $queryBuilder;
    }
}












