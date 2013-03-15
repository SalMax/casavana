<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
        /*public function invoicelistclientnameAction() {
        //Preparamos conexion
        //$doctrine = $this->getDoctrine();
        //$em = $doctrine->getEntityManager();
        //$invoices = $em->getRepository('CasavanaCOBDBundle:Invoice')->findBy(array('clientid' => $this->getUser()->getId()));
        return render(array('clientname' => 'Pablo'));
    }*/
}
