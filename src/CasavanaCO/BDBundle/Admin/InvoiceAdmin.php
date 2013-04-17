<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;

class InvoiceAdmin extends Admin {

    private function Total_Price($invoice) {

        /* * ************************************** */
        /** NO DESCOMENTAR, PUEDE QUE NOS SIRVA * */
        /* * ************************************** */

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
        $suma_precio += $invoice->getAdjust();
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
                ->add('adjust', null, array('label'=>'Price adjust'))
                ->add('status', 'choice', array('choices' => array('opened' => 'Opened', 'processing' => 'Processing', 'closed' => 'Closed', 'modified by client' => 'Modified by client')))
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
                ->addIdentifier('id', null, array('label' => 'Invoice Id'))
                ->add('clientname', null, array('label' => 'Client'))
                ->addIdentifier('invoiceDate', 'date')
                ->add('price')
                ->add('status')
                ->add('_action', 'actions', array(
                  'actions' => array(
                  'view' => array()
                      )))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('id', null, array('label'=>'Invoice Id'))
                ->add('invoiceDate', null, array('label' => 'Invoice date'))
                ->add('clientname', null, array('label'=>'Client'))
                ->add('price', null, array('template' => 'CasavanaCOBDBundle:ORMCRUD:show_price_field.html.twig'))
                ->add('invoiceproducts', null , 
                        array('template' => 'CasavanaCOBDBundle:ORMCRUD:show_orm_one_to_many.html.twig','label' => 'Products'), 
                        array()
                    )
                ->add('adjust', null, array ('label' => 'Price adjust ($)'))
        ;
    }

    public function prePersist($invoice) {
        $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setInvoiceDate($currentTime);
        $invoice->setLastmodify($currentTime);
        $invoice->setPrice($this->Total_Price($invoice));

        $invoice->setClientId($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getId());

        //Preparamos conexion
        $doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $cliente = $em->getRepository('ApplicationSonataUserBundle:User')->find($invoice->getClientId());
        $thename = $cliente->getFirstname() . " " . $cliente->getLastname();
        $invoice->setclientname($thename);

        $pedidos = $invoice->getInvoiceproducts();
        //A cada pedido le asignamos el ID del invoice
        foreach ($pedidos as $pedido_i) {
            if (isset($pedido_i)) {
                $producto = $pedido_i->setInvoice($invoice);
            }
        }
    }

    public function preUpdate($invoice) {
        $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setLastmodify($currentTime);
        $invoice->setPrice($this->Total_Price($invoice));
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