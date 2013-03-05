<?php

namespace CasavanaCO\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class CasavanaController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(){
	
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')){
			return $this->render("CasavanaCOBDBundle:Dashboard:dashboard.html.twig");
		}      
		else if($this->get('security.context')->isGranted('ROLE_ADMIN')){
			return $this->render("CasavanaCOBDBundle:Admin:admin.html.twig");
		}
		else if($this->get('security.context')->isGranted('ROLE_USER')){
			return $this->render("CasavanaCOBDBundle:Client:client.html.twig");
		}
		else{
			return $this->render("CasavanaCOBDBundle:Error:rrlogin.html.twig");
		}
		
    }
}
