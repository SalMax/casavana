<?php

namespace CasavanaCO\BDBundle\Form\Type;

/**
 * Description of ListaProductos
 *
 * @author Sergio Álvarez López <juacar@correo.ugr.es>
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\AdminBundle\Form\EventListener\ResizeFormListener;


class ListaProductos extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $listener = new ResizeFormListener(
            $builder->getFormFactory(),
            $options['type'],
            $options['type_options'],
            $options['modifiable']
        );

        $builder->addEventSubscriber($listener);
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'field';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'modifiable'    => false,
            'type'          => 'text',
            'type_options'  => array()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'listaproductos';
    }
}

?>
