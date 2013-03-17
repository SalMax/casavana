<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class PedidosAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('cantidad', null, array('label' => "Units"))
            ->add('pesototal', null, array('label' => "Invoice Weight (lbs.)"))
            ->add('product', 'sonata_type_model_list', array('required' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('cantidad')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('cantidad')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('cantidad')
                ->assertMaxLength(array('limit' => 32))
            ->end()
        ;
    }
    
    public function validatePedido(ErrorElement $errorElement, $pedido)
    {
        $errorElement
            ->with('pedido.pesototal')
                ->assertNotNull(array())
                ->assertNotBlank()
            ->end();
    }
}