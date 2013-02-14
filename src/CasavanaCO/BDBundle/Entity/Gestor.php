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
     * @var \Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DNI", referencedColumnName="DNI")
     * })
     */
    private $dni;



    /**
     * Set dni
     *
     * @param \CasavanaCO\BDBundle\Entity\Usuario $dni
     * @return Gestor
     */
    public function setDni(\CasavanaCO\BDBundle\Entity\Usuario $dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return \CasavanaCO\BDBundle\Entity\Usuario 
     */
    public function getDni()
    {
        return $this->dni;
    }
}