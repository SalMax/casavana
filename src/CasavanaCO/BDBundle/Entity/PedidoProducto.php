<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoProducto
 *
 * @ORM\Table(name="pedido - producto")
 * @ORM\Entity
 */
class PedidoProducto
{
    /**
     * @var string
     *
     * @ORM\Column(name="N", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $n;

    /**
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pedido", referencedColumnName="Ref")
     * })
     */
    private $pedido;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Producto", referencedColumnName="Ref")
     * })
     */
    private $producto;



    /**
     * Get n
     *
     * @return string 
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * Set pedido
     *
     * @param \CasavanaCO\BDBundle\Entity\Pedido $pedido
     * @return PedidoProducto
     */
    public function setPedido(\CasavanaCO\BDBundle\Entity\Pedido $pedido = null)
    {
        $this->pedido = $pedido;
    
        return $this;
    }

    /**
     * Get pedido
     *
     * @return \CasavanaCO\BDBundle\Entity\Pedido 
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set producto
     *
     * @param \CasavanaCO\BDBundle\Entity\Producto $producto
     * @return PedidoProducto
     */
    public function setProducto(\CasavanaCO\BDBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \CasavanaCO\BDBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}