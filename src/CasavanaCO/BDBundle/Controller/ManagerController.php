<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ManagerController extends Controller
{
    /**
     * @Route("/manager")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render("CasavanaCOBDBundle:Manager:manager.html.twig");
    }
}