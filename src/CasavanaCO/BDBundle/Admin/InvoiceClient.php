<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use CasavanaCO\BDBundle\Entity\Pedidos;

class InvoiceClient extends Admin {

    protected $baseRouteName = 'invoice_client';
    protected $baseRoutePattern = 'invoice_client';

    private function initInvoice() {

        //Conexion para obtener productos
        $doctrine = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();
        $repository = $em->getRepository('CasavanaCOBDBundle:Product');

        // recupera los productos
        $productos = $repository->findAll();

        //Vamos a crear una lista de productos en el mismo orden con el que vienen de la base de datos.
        $pedidos_del_invoice = $this->getSubject()->getInvoiceproducts();
        $existe = False;
        foreach ($productos as $producto) {
            $pedido_vacio = new Pedidos();
            foreach ($pedidos_del_invoice as $pedido_existente) {
                if ($pedido_existente->getProduct()->getId() == $producto->getId()) {
                    $existe = True;
                    break; //si lo encontramos, rompemos el bucle
                }
            }
            if ($existe == False) {
                $pedido_vacio->setProduct($producto);
                $pedido_vacio->setCantidad = 0;
                $this->getSubject()->addInvoiceproduct($pedido_vacio); //Agregamos el pedido vacio
            }
        }
    }

    private function Inicializar_Invoice() {

        //Preparamos el invoice
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getEntityManager();
        $this->prePersist($this->getSubject());
        //$em->persist($this->getSubject());
        //$em->flush();

        $conn = $this->getConfigurationPool()->getContainer()->get('database_connection');
        $productos = $this->getSubject()->getallproductsObjects();
        $nproductos = count($productos);
        $pedidos = array($nproductos);
        $i = 1;

        foreach ($productos as $p) {
            $existe = false;
            $pedidos_del_invoice = $this->getSubject()->getInvoiceproducts();
            foreach ($pedidos_del_invoice as $pi) {
                if ($pi->getProduct()->getId() == $p->getId()) {
                    $existe = true;
                    $nproductos--;
                }
            }

            if ($existe == false) {

                $pedidos[$i] = new Pedidos();
                $pedidos[$i]->setPesototal(0);
                $pedidos[$i]->setCantidad(0);
                $pedidos[$i]->setSubtotal(0);
                $em->persist($pedidos[$i]);
                $em->flush();

                $sql = 'UPDATE Pedidos SET product_id=' . $p->getId() . ' WHERE id=' . $pedidos[$i]->getId();
                $rows = $conn->query($sql);
                //$sql = 'UPDATE Pedidos SET invoice_id='.$this->getSubject()->getId().' WHERE id=' . $pedidos[$i]->getId();
                //$rows = $conn->query($sql);

                $i++;
            }
        }

        for ($i = 1; $i <= $nproductos; $i++) {
            $pedidos[$i]->setInvoice($this->getSubject());

            //$em->persist($pedidos[$i]);
            //$em->flush();
            //$em->persist($pedidos[$i]);
            //$em->flush();
            //$this->getSubject()->setPrice($i);
            //$this->getSubject()->addInvoiceproduct($pedidos[$i]);
            //$em->persist($pedidos[$i]);
            //$em->flush();
        }
    }

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
        $suma_precio += $invoice->getAdjust();
        //$this->getForm()->getAttribute('cantidad');
        return $suma_precio;
    }

    protected function configureFormFields(FormMapper $formMapper) {

        //Si el pedido está cerrado
        //Solo escritura
        if (strcmp($this->getSubject()->getStatus(), 'closed') == 0) {
            $formMapper
                    ->add('invoiceproducts', 'sonata_type_collection', array('label' => 'Products', 'read_only' => true), array(
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
            //$this->Inicializar_Invoice();
            $this->initInvoice();

            $formMapper
                    ->with('Productos')
                    //->add('invoiceproducts', 'sonata_type_collection', array('label' => 'Products'), array('edit' => 'inline', 'inline' => 'table', 'sortable' => 'position'))
                    ->add('invoiceproducts', 'sonata_type_collection', array('label' => 'Products'), array('edit' => 'inline', 'inline' => 'table', 'sortable' => 'position'))
                    ->end()
                    ->add('price', null, array('read_only' => true))
                    ->add('status', null, array('read_only' => true))
            ;
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
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array()
            )))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('id', null, array('label' => 'Invoice Id'))
                ->add('invoiceDate', null, array('label' => 'Invoice date'))
                ->add('clientname', null, array('label' => 'Client'))
                ->add('price', null, array('template' => 'CasavanaCOBDBundle:ORMCRUD:show_price_field.html.twig'))
                ->add('invoiceproducts', null, array('template' => 'CasavanaCOBDBundle:ORMCRUD:show_orm_one_to_many.html.twig', 'label' => 'Products'), array()
                )
                ->add('adjust', null, array('label' => 'Price adjust ($)'))


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

        //Borramos los pedidos con unidad 0 y peso a 0 antes de grabarlos
        $pedidos = $this->getSubject()->getInvoiceproducts();
        foreach ($pedidos as $pedido) {
            if ($pedido->getCantidad() == 0 && $pedido->getPesototal() == 0) {
                $this->getSubject()->removeInvoiceproduct($pedido);
            }
        }
    }

    /* public function postPersist($invoice) {
      $conn = $this->getConfigurationPool()->getContainer()->get('database_connection');
      $sql = 'DELETE FROM Pedidos WHERE invoice_id IS NULL';
      $rows = $conn->query($sql);
      } */

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

        //Borramos los pedidos con unidad 0 y peso a 0 antes de grabarlos
        $pedidos = $this->getSubject()->getInvoiceproducts();
        foreach ($pedidos as $pedido) {
            if ($pedido->getCantidad() == 0 && $pedido->getPesototal() == 0) {
                $this->getSubject()->removeInvoiceproduct($pedido);
            }
        }
        
    }

    /* public function postUpdate($invoice) {
      $conn = $this->getConfigurationPool()->getContainer()->get('database_connection');
      $sql = 'DELETE FROM Pedidos WHERE invoice_id IS NULL';
      $rows = $conn->query($sql);
      } */
}

