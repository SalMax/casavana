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
        return $this->List_Client_Invoices();
    }

    public function List_Client_Invoices() {
        //Preparamos conexion
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getEntityManager();
        $invoices = $em->getRepository('CasavanaCOBDBundle:Invoice')->findBy(array('clientid' => $this->getUser()->getId()));
        return $this->render("CasavanaCOBDBundle:Client:client_my_invoices.html.twig", array('invoices' => $invoices));
    }

}