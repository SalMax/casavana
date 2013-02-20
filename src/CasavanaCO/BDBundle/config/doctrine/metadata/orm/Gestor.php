<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Gestor
 *
 * @ORM\Table(name="gestor")
 * @ORM\Entity
 */
class Gestor
{
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
