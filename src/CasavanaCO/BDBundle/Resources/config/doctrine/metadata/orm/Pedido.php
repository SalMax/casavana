<?php



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
     * @ORM\Column(name="Fecha Pedido", type="date", nullable=false)
     */
    private $fechaPedido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha Modificacion", type="date", nullable=false)
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


}
