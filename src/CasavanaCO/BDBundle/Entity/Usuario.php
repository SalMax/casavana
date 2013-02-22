<?php

namespace CasavanaCO\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
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
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido1", type="string", length=45, nullable=false)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellido2", type="string", length=45, nullable=true)
     */
    private $apellido2;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=45, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=45, nullable=false)
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha_Alta", type="date", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha_Ultimo_Acceso", type="date", nullable=false)
     */
    private $fechaUltimoAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Usuario", type="string", length=45, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="Clave", type="string", length=45, nullable=false)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="DNI_Administrador", type="string", length=45, nullable=false)
     */
    private $dniAdministrador;



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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set apellido1
     *
     * @param string $apellido1
     * @return Usuario
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    
        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string 
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     * @return Usuario
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    
        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string 
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Usuario
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    
        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaUltimoAcceso
     *
     * @param \DateTime $fechaUltimoAcceso
     * @return Usuario
     */
    public function setFechaUltimoAcceso($fechaUltimoAcceso)
    {
        $this->fechaUltimoAcceso = $fechaUltimoAcceso;
    
        return $this;
    }

    /**
     * Get fechaUltimoAcceso
     *
     * @return \DateTime 
     */
    public function getFechaUltimoAcceso()
    {
        return $this->fechaUltimoAcceso;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Usuario
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
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return Usuario
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    
        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set dniAdministrador
     *
     * @param string $dniAdministrador
     * @return Usuario
     */
    public function setDniAdministrador($dniAdministrador)
    {
        $this->dniAdministrador = $dniAdministrador;
    
        return $this;
    }

    /**
     * Get dniAdministrador
     *
     * @return string 
     */
    public function getDniAdministrador()
    {
        return $this->dniAdministrador;
    }
}