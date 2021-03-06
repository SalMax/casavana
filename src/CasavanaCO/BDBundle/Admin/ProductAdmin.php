<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormType;

class ProductAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            ->add('cost')
            ->add('margin')
            ->add('price_by','choice', array('choices' => array('unit' => 'Unit', 'lb' => 'Lb')))
            ->add('category', 'sonata_type_model_list', array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('cost')
            ->add('margin')
            ->add('price')
            ->add('_action', 'actions', array(
            'actions' => array(
		        'view' => array()
				    )))
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
                ->add('name')
                ->add('price')
            
        ;
    }
    
    public function prePersist($product)
    {
        $product->setPrice($product->getCost()+$product->getMargin());
        
    }
    
    public function preUpdate($product)
    {
        $product->setPrice($product->getCost()+$product->getMargin());
        
    }
}