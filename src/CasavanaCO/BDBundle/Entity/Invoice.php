<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Entity
 */
class Invoice{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="CasavanaCO\BDBundle\Entity\Pedidos", mappedBy="invoice", cascade={"persist", "remove"})
     */ 
    protected $invoiceproducts;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    protected $price;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=false)
     */
    protected $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    protected $invoiceDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    protected $lastmodify;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();

    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Invoice
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Invoice
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set invoiceDate
     *
     * @param \DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    
        return $this;
    }

    /**
     * Get invoiceDate
     *
     * @return \DateTime 
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set lastmodify
     *
     * @param \DateTime $lastmodify
     * @return Invoice
     */
    public function setLastmodify($lastmodify)
    {
        $this->lastmodify = $lastmodify;
    
        return $this;
    }

    /**
     * Get lastmodify
     *
     * @return \DateTime 
     */
    public function getLastmodify()
    {
        return $this->lastmodify;
    }



    /**
     * Add invoiceproducts
     *
     * @param \CasavanaCO\BDBundle\Entity\Pedidos $invoiceproducts
     * @return Invoice
     */
    public function addInvoiceproduct(\CasavanaCO\BDBundle\Entity\Pedidos $invoiceproducts)
    {
        $this->invoiceproducts[] = $invoiceproducts;
    
        return $this;
    }

    /**
     * Remove invoiceproducts
     *
     * @param \CasavanaCO\BDBundle\Entity\Pedidos $invoiceproducts
     */
    public function removeInvoiceproduct(\CasavanaCO\BDBundle\Entity\Pedidos $invoiceproducts)
    {
        $this->invoiceproducts->removeElement($invoiceproducts);
    }

    /**
     * Get invoiceproducts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceproducts()
    {
        return $this->invoiceproducts;
    }
}