<?php

namespace CasavanaCO\BDBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CasavanaCOBDBundle extends Bundle
{
	public function getParent()
	{
	    return 'SonataAdminBundle';
	}
}
