<?php



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


}
