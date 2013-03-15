<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class InvoiceAdmin extends Admin {

    private function Total_Price($invoice) {

        /*         * ************************************** */
        /** NO DESCOMENTAR, PUEDE QUE NOS SIRVA * */
        /*         * ************************************** */

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
            $suma_precio = $suma_precio + $producto->getPrice() * $pedido_i->getCantidad();
            //}
        }
        //$this->getForm()->getAttribute('cantidad');
        return $suma_precio;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('invoiceproducts', 'sonata_type_collection', array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'))
                ->add('price', null, array('read_only' => true))
                ->add('status', 'choice', array('choices' => array('opened' => 'Opened', 'processing' => 'Processing', 'closed' => 'Closed')))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('invoiceDate')
                ->add('status')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {

        $listMapper
                ->addIdentifier('id')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'act' => array('template' => 'CasavanaCOBDBundle:Invoice_List:invoice_list_client.html.twig'))))
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
        $invoice->setPrice($this->Total_Price($invoice));

        $invoice->setClientId($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getId());

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
        $invoice->setPrice($this->Total_Price($invoice));

        $invoice->setClientId($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getId());

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