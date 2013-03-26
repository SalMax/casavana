<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class InvoiceClient extends Admin {

    protected $baseRouteName = 'invoice_client';
    protected $baseRoutePattern = 'invoice_client';

    private function Total_Price($invoice) {

        $suma_precio = 0;
        //Preparamos conexion
        //$doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        //$em = $doctrine->getEntityManager();
        //$producto = $em->getRepository('CasavanaCOBDBundle:Product')->find("$pedidos[$i]->getProduct().getId()");
        //Capturamos los pedidos
        $pedidos = $invoice->getInvoiceproducts();
        //Para cada pedido buscamos los productos asociados
        foreach ($pedidos as $pedido_i) {
            //for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            //if(isset($pedido_i)){
            $producto = $pedido_i->getProduct();
            //Si el precio de este producto es por peso...
            if (strcmp($producto->getPriceBy(), 'lb') == 0) {
                $pedido_i->setSubtotal($producto->getPrice() * $pedido_i->getPesototal());
                $suma_precio = $suma_precio + $producto->getPrice() * $pedido_i->getPesototal();
            } else {
                $pedido_i->setSubtotal($producto->getPrice() * $pedido_i->getCantidad());
                $suma_precio = $suma_precio + $producto->getPrice() * $pedido_i->getCantidad();
            }
            //}
        }
        //$this->getForm()->getAttribute('cantidad');
        return $suma_precio;
    }

    protected function configureFormFields(FormMapper $formMapper) {

        //Si el pedido está cerrado
        //Solo escritura
        if (strcmp($this->getSubject()->getStatus(), 'closed') == 0) {

            $formMapper
                    ->add('invoiceproducts', 'sonata_type_collection', array('label' => 'Products','read_only' => true), array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position'))
                    ->add('price', null, array('read_only' => true))
                    ->add('status', null, array('read_only' => true))
            ;
        }
        //Si no esta cerrado
        //Se puede modificar
        else {
            $formMapper
                    ->add('invoiceproducts', 'sonata_type_collection', array(), array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position'))
                    ->add('price', null, array('read_only' => true))
                    ->add('status', null, array('read_only' => true));
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('invoiceDate')
                ->add('status')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('invoiceDate', 'date')
                ->add('price')
                ->add('status')
        //->add('status','choice', array('choices' => array('opened' => 'Opened', 'processing' => 'Processing', 'closed' => 'Closed')))
        /* ->add('_action', 'actions', array(
          'actions' => array(
          'act' => array('template' => 'CasavanaCOBDBundle:Invoice_List:Status.html.twig')))) */
        /* ->add('_action', 'actions', array(
          'actions' => array(
          'edit' => array(),
          'delete' => array()))) */
        ;
    }

    public function prePersist($invoice) {
        $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setInvoiceDate($currentTime);
        $invoice->setLastmodify($currentTime);
        //$invoice->setPrice($this->Total_Price($invoice));
        $invoice->setStatus('opened');

        $invoice->setClientId($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getId());

        //Preparamos conexion
        $doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $cliente = $em->getRepository('ApplicationSonataUserBundle:User')->find($invoice->getClientId());
        $thename = $cliente->getFirstname() . " " . $cliente->getLastname();
        $invoice->setclientname($thename);

        if (strcmp($invoice->getStatus(), 'processing') == 0) {
            $invoice->setStatus('modified by client');
        }

        $pedidos = $invoice->getInvoiceproducts();
        //A cada pedido le asignamos el ID del invoice
        foreach ($pedidos as $pedido_i) {
            //for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            if (isset($pedido_i)) {
                $producto = $pedido_i->setInvoice($invoice);
            }
        }
    }

    public function preUpdate($invoice) {
        $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setLastmodify($currentTime);
        //$invoice->setPrice($this->Total_Price($invoice));
        $invoice->setClientId($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getId());

        if (strcmp($invoice->getStatus(), 'processing') == 0) {
            $invoice->setStatus('modified by client');
        }

        $pedidos = $invoice->getInvoiceproducts();
        //A cada pedido le asignamos el ID del invoice
        foreach ($pedidos as $pedido_i) {
            //for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            if (isset($pedido_i)) {
                $producto = $pedido_i->setInvoice($invoice);
            }
        }
    }

}