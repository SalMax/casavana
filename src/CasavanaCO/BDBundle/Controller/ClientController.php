<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClientController extends Controller
{
    /**
     * @Route("/client")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render("CasavanaCOBDBundle:Client:client.html.twig");    
    }
}