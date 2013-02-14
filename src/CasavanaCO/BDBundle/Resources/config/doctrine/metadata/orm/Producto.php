<?php



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


}
