<?php

namespace CasavanaCO\BDBundle\Admin\Filter;

use Symfony\Component\Security\Core\SecurityContext;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

class OwnerInvoiceFilter {
    /**
     * @var SecurityContext
     */
    private $securityContext;

    private $ownerFieldName = 'clientid';

    public function __construct(SecurityContext $securityContext, $ownerFieldName = null)
    {
        $this->securityContext = $securityContext;
        if ($ownerFieldName)
            $this->ownerFieldName = $ownerFieldName;
    }

    public function apply(ProxyQueryInterface $query)
    {
        /* @var \Symfony\Component\Security\Core\TokenInterface $token */
        $token = $this->securityContext->getToken();
        $user = $token->getUser();

        if ($user) {
            /*
            if (!($user instanceof \CasavanaCO\BDBundle\Entity\User)) {
                throw new InvalidArgumentException("User %s is not of type CasavanaCO\\BDBundle\\Entity\\User", $user);
            }
            */

            // Admins are allowed to view all
            if ($this->securityContext->isGranted('ROLE_ADMIN'))
                return;

            $r = rand(100000, 999999);
            $alias = $query->getRootAlias();

            $paramName = $this->ownerFieldName . $r;
            $query->andWhere($query->expr()->eq(sprintf('%s.%s', $alias, $this->ownerFieldName ), ':'.$paramName));
            $query->setParameter($paramName, $user->getId());
        }
    }
}