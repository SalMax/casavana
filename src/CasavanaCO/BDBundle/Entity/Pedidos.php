<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Pedidos {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $cantidad;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $pesototal;
    
   /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $subtotal;

    /**
     * @ORM\ManyToOne(targetEntity="CasavanaCO\BDBundle\Entity\Product", inversedBy="pedidos")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="CasavanaCO\BDBundle\Entity\Invoice", inversedBy="invoiceproducts")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     * */
    protected $invoice;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set product
     *
     * @param \CasavanaCO\BDBundle\Entity\Product $product
     * @return Pedidos
     */
    public function setProduct(\CasavanaCO\BDBundle\Entity\Product $product = null) {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \CasavanaCO\BDBundle\Entity\Product 
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return Pedidos
     */
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Set invoice
     *
     * @param \CasavanaCO\BDBundle\Entity\Invoice $invoice
     * @return Pedidos
     */
    public function setInvoice(\CasavanaCO\BDBundle\Entity\Invoice $invoice = null) {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \CasavanaCO\BDBundle\Entity\Invoice 
     */
    public function getInvoice() {
        return $this->invoice;
    }

    /**
     * Set pesototal
     *
     * @param string $pesototal
     * @return Pedidos
     */
    public function setPesototal($pesototal) {
        $this->pesototal = $pesototal;

        return $this;
    }

    /**
     * Get pesototal
     *
     * @return string 
     */
    public function getPesototal() {
        return $this->pesototal;
    }

    /**
     * Set subtotal
     *
     * @param string $subtotal
     * @return Pedidos 
     */
    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
        return $this;
    }

    /**
     * Get subtotal
     *
     * @return string 
     */
    public function getSubtotal() {
        return $this->subtotal;
    }

}