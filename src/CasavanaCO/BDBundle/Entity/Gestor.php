<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestor
 *
 * @ORM\Table(name="gestor")
 * @ORM\Entity
 */
class Gestor
{
    /**
     * @var string
     *
     * @ORM\Column(name="DNI", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dni;



    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }
}