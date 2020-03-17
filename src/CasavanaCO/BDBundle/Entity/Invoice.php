<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use CasavanaCO\BDBundle\ApplicationBoot;

/**
 * Invoice
 *
 * @ORM\Entity
 */
class Invoice{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=90, nullable=false)
     */
    private $clientname;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    * @ORM\Column(type="integer")
    * @ORM\ManyToOne(targetEntity="CasavanaCO\BDBundle\Entity\User", inversedBy="invoice")
    * @ORM\JoinColumn(name="clientid", referencedColumnName="id")
    */
    protected $clientid;

    /**
     * @ORM\OneToMany(targetEntity="CasavanaCO\BDBundle\Entity\Pedidos", mappedBy="invoice", cascade={"all"}, orphanRemoval=true)
     */ 
    protected $invoiceproducts;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $price;
    
    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $adjust;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adjustComment;
    
    
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
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $expectedDelivery;

     /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deliveryDay;
    
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoiceproducts = new \Doctrine\Common\Collections\ArrayCollection();

    }
    
    /**
     * Get id
     *
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set client_id
     *
     * @param integer $client_id
     * @return Invoice
     */
    public function setClientId($clientid)
    {
        $this->clientid = $clientid;
        return $this;
    }

    /**
     * Get client_id
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientid;
    }
    
    public function setclientname($name)
    {
        $this->clientname = $name;
        return $this;
    }
    
    public function getclientname()
    {
        return $this->clientname;
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
     * Set price
     *
     * @param float $price
     * @return Invoice
     */
    public function setAdjust($adjust)
    {
        $this->adjust = $adjust;
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getAdjust()
    {
        return $this->adjust;
    }

     /**
     * Set adjustComment
     *
     * @param string $adjustComment
     * @return Invoice
     */
    public function setAdjustComment($adjustComment)
    {
        $this->adjustComment = $adjustComment;
    
        return $this;
    }

    /**
     * Get adjustComment
     *
     * @return string 
     */
    public function getAdjustComment()
    {
        return $this->adjustComment;
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
     * Set expectedDelivery
     *
     * @param \DateTime $expectedDelivery
     * @return Invoice
     */
    public function setExpectedDelivery($expectedDelivery)
    {
        $this->expectedDelivery = $expectedDelivery;
    
        return $this;
    }

    /**
     * Get expectedDelivery
     *
     * @return \DateTime 
     */
    public function getExpectedDelivery()
    {
        return $this->expectedDelivery;
    }

    /**
     * Set deliveryDay
     *
     * @param \DateTime $deliveryDay
     * @return Invoice
     */
    public function setDeliveryDay($deliveryDay)
    {
        $this->deliveryDay = $deliveryDay;
    
        return $this;
    }

    /**
     * Get deliveryDay
     *
     * @return \DateTime 
     */
    public function getDeliveryDay()
    {
        return $this->deliveryDay;
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