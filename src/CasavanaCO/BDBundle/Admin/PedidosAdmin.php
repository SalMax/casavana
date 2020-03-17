<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class PedidosAdmin extends Admin {

    /**
     * Con esto conseguimos que en la vista de crear invoice: 
     * - Desaparezca el boton de agregar producto, puesto que ya se muestra una lista con todos los productos disponibles para hacer pedidos
     * - Desaparezca el chack para borar un pedido, puesto que basta con dejar las unidades de ese producto en blanco o a cero.
     **/
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('batch');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        
        // El super administrador tiene todos los roles, solo hay que comprobar para el MANAGER
        if ($this->getConfigurationPool()->getContainer()->get('security.context')->isGranted('ROLE_MANAGER')){
            $formMapper
                    ->add('cantidad', null, array('label' => "Units",'required' => false,'empty_data' => '0'))
                    ->add('pesototal', null, array('label' => "Invoice Weight (lbs.)", 'empty_data' => '0', 'required' => false))
                    ->add('product', 'sonata_type_model_list', array('required' => true))
                    ->add('subtotal', null, array('label' => "Subtotal", 'read_only' => true, 'empty_data' => '0', 'required' => false))

            ;
            
        }else if(($this->getConfigurationPool()->getContainer()->get('security.context')->isGranted('ROLE_CLIENT'))){
            $formMapper
                    ->add('cantidad', null, array('label' => "Units",'required' => false,'empty_data' => '0'))
                    ->add('product', 'sonata_type_model_list', array('required' => true))

            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('cantidad')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('cantidad')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('cantidad')
                ->add('pesototal')
                ->add('product')
                ->add('subtotal')
            
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object) {
        $errorElement
                ->with('cantidad')
                ->assertMaxLength(array('limit' => 32))
                ->end()
        ;
    }

    public function validatePedido(ErrorElement $errorElement, $pedido) {

        $errorElement
                ->with('pedido.pesototal')
                ->assertNotNull(array())
                ->assertNotBlank()
                ->end();
    }

}