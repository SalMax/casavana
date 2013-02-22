<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity
 */
class Pedido
{
    /**
     * @var string
     *
     * @ORM\Column(name="Ref", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ref;

    /**
     * @var float
     *
     * @ORM\Column(name="Coste", type="decimal", nullable=false)
     */
    private $coste;

    /**
     * @var float
     *
     * @ORM\Column(name="Precio", type="decimal", nullable=false)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha_Pedido", type="date", nullable=false)
     */
    private $fechaPedido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha_Modificacion", type="date", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DNI_Cliente", referencedColumnName="DNI")
     * })
     */
    private $dniCliente;

    /**
     * @var \Gestor
     *
     * @ORM\ManyToOne(targetEntity="Gestor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DNI_Gestor", referencedColumnName="DNI")
     * })
     */
    private $dniGestor;



    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set coste
     *
     * @param float $coste
     * @return Pedido
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;
    
        return $this;
    }

    /**
     * Get coste
     *
     * @return float 
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Pedido
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Pedido
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaPedido
     *
     * @param \DateTime $fechaPedido
     * @return Pedido
     */
    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;
    
        return $this;
    }

    /**
     * Get fechaPedido
     *
     * @return \DateTime 
     */
    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Pedido
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set dniCliente
     *
     * @param \CasavanaCO\BDBundle\Entity\Cliente $dniCliente
     * @return Pedido
     */
    public function setDniCliente(\CasavanaCO\BDBundle\Entity\Cliente $dniCliente = null)
    {
        $this->dniCliente = $dniCliente;
    
        return $this;
    }

    /**
     * Get dniCliente
     *
     * @return \CasavanaCO\BDBundle\Entity\Cliente 
     */
    public function getDniCliente()
    {
        return $this->dniCliente;
    }

    /**
     * Set dniGestor
     *
     * @param \CasavanaCO\BDBundle\Entity\Gestor $dniGestor
     * @return Pedido
     */
    public function setDniGestor(\CasavanaCO\BDBundle\Entity\Gestor $dniGestor = null)
    {
        $this->dniGestor = $dniGestor;
    
        return $this;
    }

    /**
     * Get dniGestor
     *
     * @return \CasavanaCO\BDBundle\Entity\Gestor 
     */
    public function getDniGestor()
    {
        return $this->dniGestor;
    }
}