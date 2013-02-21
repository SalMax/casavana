<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidoproducto
 *
 * @ORM\Table(name="pedidoproducto")
 * @ORM\Entity
 */
class Pedidoproducto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="N", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $n;

    /**
     * @var string
     *
     * @ORM\Column(name="Pedido", type="string", length=10, nullable=false)
     */
    private $pedido;

    /**
     * @var string
     *
     * @ORM\Column(name="Producto", type="string", length=10, nullable=false)
     */
    private $producto;



    /**
     * Get n
     *
     * @return integer 
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * Set pedido
     *
     * @param string $pedido
     * @return Pedidoproducto
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    
        return $this;
    }

    /**
     * Get pedido
     *
     * @return string 
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set producto
     *
     * @param string $producto
     * @return Pedidoproducto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return string 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}