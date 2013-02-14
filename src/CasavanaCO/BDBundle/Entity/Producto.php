<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity
 */
class Producto
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
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="Coste", type="decimal", nullable=false)
     */
    private $coste;

    /**
     * @var float
     *
     * @ORM\Column(name="Margen", type="decimal", nullable=false)
     */
    private $margen;

    /**
     * @var float
     *
     * @ORM\Column(name="Precio", type="decimal", nullable=false)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="Categoria", type="string", length=45, nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=45, nullable=false)
     */
    private $estado;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set coste
     *
     * @param float $coste
     * @return Producto
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
     * Set margen
     *
     * @param float $margen
     * @return Producto
     */
    public function setMargen($margen)
    {
        $this->margen = $margen;
    
        return $this;
    }

    /**
     * Get margen
     *
     * @return float 
     */
    public function getMargen()
    {
        return $this->margen;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Producto
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
     * Set categoria
     *
     * @param string $categoria
     * @return Producto
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Producto
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
     * Set dniGestor
     *
     * @param \CasavanaCO\BDBundle\Entity\Gestor $dniGestor
     * @return Producto
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