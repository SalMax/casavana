<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use CasavanaCO\BDBundle\Entity\Pedidos;

class InvoiceAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction 
        '_sort_by' => 'invoiceDate' // field name 
    );

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

    private function initInvoice() {

        //Conexion para obtener productos
        $doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $repository = $em->getRepository('CasavanaCOBDBundle:Product');

        // recupera los productos
        $productos = $repository->findAll();

        //Vamos a crear una lista de productos en el mismo orden con el que vienen de la base de datos.
        $pedidos_del_invoice = $this->getSubject()->getInvoiceproducts();
        foreach ($productos as $producto) {
            $existe = False;
            $pedido_vacio = new Pedidos();
            foreach ($pedidos_del_invoice as $pedido_existente) {
                if ($pedido_existente->getProduct()->getId() == $producto->getId()) {
                    $existe = True;
                }
            }
            if ($existe == False) {
                $pedido_vacio->setProduct($producto);
                $pedido_vacio->setCantidad = 0;
                $this->getSubject()->addInvoiceproduct($pedido_vacio); //Agregamos el pedido vacio
            }
        }

        //Valores iniciales para las fechas de entrega del pedido
        if ($this->getSubject()->getExpectedDelivery()==null){
            $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
            $this->getSubject()->setExpectedDelivery($currentTime);
        }

        if ($this->getSubject()->getDeliveryDay()==null){
            $currentTime = new \DateTime(date('m/d/Y h:i:s a', time()));
            $this->getSubject()->setDeliveryDay($currentTime);
        }
    }

    protected function configureFormFields(FormMapper $formMapper) {

        $this->initInvoice();

        $formMapper
                ->add('invoiceproducts', 'sonata_type_collection', array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'))
                ->add('price', null, array('read_only' => true))
                ->add('adjust', null, array('label'=>'Price adjust'))
                ->add('adjustComment', null, array('label'=>'Adjust Comment'))
                ->add('expectedDelivery', null, array('label'=>'Expected Delivery'))
                ->add('deliveryDay', null, array('label'=>'Delivery Day'))
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

        //Borramos los pedidos con unidad 0 y peso a 0 antes de grabarlos
        $pedidos = $this->getSubject()->getInvoiceproducts();
        foreach ($pedidos as $pedido) {
            if ($pedido->getCantidad() == 0 && $pedido->getPesototal() == 0) {
                $this->getSubject()->removeInvoiceproduct($pedido);
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

        //Borramos los pedidos con unidad 0 y peso a 0 antes de grabarlos
        $pedidos = $this->getSubject()->getInvoiceproducts();
        foreach ($pedidos as $pedido) {
            if ($pedido->getCantidad() == 0 && $pedido->getPesototal() == 0) {
                $this->getSubject()->removeInvoiceproduct($pedido);
            }
        }
    }

}