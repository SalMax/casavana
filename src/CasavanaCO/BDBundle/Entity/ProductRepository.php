<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM CasavanaCOBDBundle:Product p ORDER BY p.name ASC' )
            ->getResult();
    }
}
