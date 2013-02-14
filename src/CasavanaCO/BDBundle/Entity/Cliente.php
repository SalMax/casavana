<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="N_Pedidos", type="integer", nullable=false)
     */
    private $nPedidos;

    /**
     * @var float
     *
     * @ORM\Column(name="Desembolso", type="decimal", nullable=false)
     */
    private $desembolso;

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
     * Set nPedidos
     *
     * @param integer $nPedidos
     * @return Cliente
     */
    public function setNPedidos($nPedidos)
    {
        $this->nPedidos = $nPedidos;
    
        return $this;
    }

    /**
     * Get nPedidos
     *
     * @return integer 
     */
    public function getNPedidos()
    {
        return $this->nPedidos;
    }

    /**
     * Set desembolso
     *
     * @param float $desembolso
     * @return Cliente
     */
    public function setDesembolso($desembolso)
    {
        $this->desembolso = $desembolso;
    
        return $this;
    }

    /**
     * Get desembolso
     *
     * @return float 
     */
    public function getDesembolso()
    {
        return $this->desembolso;
    }

    /**
     * Set dni
     *
     * @param \CasavanaCO\BDBundle\Entity\Usuario $dni
     * @return Cliente
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