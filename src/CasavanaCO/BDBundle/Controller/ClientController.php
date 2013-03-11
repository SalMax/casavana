<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\EntityManager;

class ClientController extends Controller {

    private $hola;
    private $invoices;

    /**
     * @Route("/client")
     * @Template()
     */
    public function indexAction() {
        //Preparamos conexion
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getEntityManager();
        $invoices = $em->getRepository('CasavanaCOBDBundle:Invoice')->findAll();
        
        return $this->render("CasavanaCOBDBundle:Client:client.html.twig", array('invoices' => $invoices));
    }

}