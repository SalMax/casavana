<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class InvoiceAdmin extends Admin
{
    //private $doctrine;
    //private $em;
    
    private function Total_Price($invoice){
        
        /*****************************************/
        /** NO DESCOMENTAR, PUEDE QUE NOS SIRVA **/
        /*****************************************/
        
        $suma_precio = 0;
        //Preparamos conexion
        //$doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        //$em = $doctrine->getEntityManager();
        
        //Capturamos los pedidos
        $pedidos = $invoice->getInvoiceproducts();
        
        //Para cada pedido buscamos los productos asociados
        for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            //Realizamos las consulta
            //$producto = $em->getRepository('CasavanaCOBDBundle:Product')->find("$pedidos[$i]->getProduct().getId()");
            $producto = $pedidos[$i]->getProduct();
            $suma_precio = $suma_precio + $producto->getPrice() * $pedidos[$i]->getCantidad();
        }
        //$this->getForm()->getAttribute('cantidad');
        return $suma_precio;
    }
    

    protected function configureFormFields(FormMapper $formMapper)
    {    

        
        $formMapper
            ->add('invoiceproducts', 'sonata_type_collection', array(), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'position'))
            ->add('price',null,array('read_only'=>true))
            ->add('status','choice', array('choices' => array('opened' => 'Opened', 'processing' => 'Processing', 'closed' => 'Closed')))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('invoiceDate')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('invoiceDate','date')
            ->add('price')
            ->add('status')
            ->add('_action', 'actions', array(
            'actions' => array(
		        'edit' => array(),
		        'delete' => array()
				    )))
        ;
        
    }
    
    public function prePersist($invoice)
    {
    	$currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setInvoiceDate($currentTime);
        $invoice->setLastmodify($currentTime);
        $invoice->setPrice($this->Total_Price($invoice));
        
        $pedidos = $invoice->getInvoiceproducts();
        //A cada pedido le asignamos el ID del invoice
        for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            if(isset($pedidos[$i])){
                $producto = $pedidos[$i]->setInvoice($invoice);
            }
        }
    }
    
    public function preUpdate($invoice)
    {   
    	$currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
        $invoice->setLastmodify($currentTime);
        $invoice->setPrice($this->Total_Price($invoice));
        
        $pedidos = $invoice->getInvoiceproducts();
        
        //A cada pedido le asignamos el ID del invoice
        for ( $i = 0 ; $i < count($pedidos) ; $i ++) {
            if(isset($pedidos[$i])){
                $producto = $pedidos[$i]->setInvoice($invoice);
            }
        }
    }
    
}