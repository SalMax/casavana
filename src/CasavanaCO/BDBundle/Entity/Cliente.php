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
     * @var string
     *
     * @ORM\Column(name="DNI", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dni;

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
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

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
}