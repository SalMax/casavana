<?php

namespace CasavanaCO\BDBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use FOS\UserBundle\Model\UserManagerInterface;

class UserAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('General')
                ->add('username')
                ->add('plainPassword', 'text', array('required' => false))
                ->add('email')
                ->end()
                ->with('Profile')
                ->add('dateOfBirth', 'birthday', array('required' => false))
                ->add('firstname', null, array('required' => false))
                ->add('lastname', null, array('required' => false))
                //->add('website', 'url', array('required' => false))
                //->add('biography', 'text', array('required' => false))
                ->add('gender', 'textarea', array('required' => false))
                ->add('locale', 'locale', array('required' => false))
                //->add('timezone', 'timezone', array('required' => false))
                ->add('phone', null, array('required' => false))
                ->end()
        /* ->with('Social')
          ->add('facebookUid', null, array('required' => false))
          ->add('facebookName', null, array('required' => false))
          ->add('twitterUid', null, array('required' => false))
          ->add('twitterName', null, array('required' => false))
          ->add('gplusUid', null, array('required' => false))
          ->add('gplusName', null, array('required' => false))
          ->end() */
        ;
        if (!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                    ->with('Management')
                    ->add('roles', 'sonata_security_roles', array(
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false
                    ))
                    ->add('locked', null, array('required' => false))
                    ->add('expired', null, array('required' => false))
                    ->add('enabled', null, array('required' => false))
                    ->add('credentialsExpired', null, array('required' => false))
                    ->end()
            ;
        }
    }

    /*protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('username')
        ;
    }*/

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            //->add('groups')
            ->add('enabled', null, array('editable' => true))
            ->add('locked', null, array('editable' => true))
            ->add('createdAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }

}