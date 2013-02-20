<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="N_Pedidos", type="integer", nullable=false)
     */
    private $nPedidos;

    /**
     * @var float
     *
     * @ORM\Column(name="Desembolso", type="decimal", nullable=false)
     */
    private $desembolso;

    /**
     * @var \Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DNI", referencedColumnName="DNI")
     * })
     */
    private $dni;


}
