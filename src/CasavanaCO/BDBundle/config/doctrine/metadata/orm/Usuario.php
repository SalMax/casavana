<?php



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
     * @ORM\Column(name="Fecha Alta", type="date", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha Ultimo Acceso", type="date", nullable=false)
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


}
