<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\ResolvedFormTypeInterface;
use Symfony\Component\Form\FormTypeInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityManager;
        
class InvoiceListController extends Controller {


    /**
     * @Route("/admin")
     * @Template()
     */
    public function indexAction() {
        //Preparamos conexion
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getEntityManager();
        //$invoices = $em->getRepository('CasavanaCOBDBundle:Invoice')->findBy(array('clientid' => $this->getUser()->getId()));
        return $this->render("CasavanaCOBDBundle:Invoice_List:invoice_list_client.html.twig", array('invoice.clientname' => 'Pablo'));
    }

}