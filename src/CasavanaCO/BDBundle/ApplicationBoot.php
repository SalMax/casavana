<?php

namespace CasavanaCO\BDBundle;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__FILE__). '/../../../app/bootstrap.php.cache';
require_once dirname(__FILE__). '/../../../app/AppKernel.php';

class ApplicationBoot {
  private static $kernel;

  public static function getContainer() {
    if(self::$kernel instanceof \AppKernel) {
      if(!self::$kernel->getContainer() instanceof Container){
        self::$kernel->boot();
    }            
    return self::$kernel->getContainer();
  }

  $environment = 'prod';
  if (!array_key_exists('REMOTE_ADDR', $_SERVER) || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', 'localhost'))) {
    $environment = 'dev';
  }

  self::$kernel = new \AppKernel($environment, false);
  self::$kernel->boot();
  return self::$kernel->getContainer();
  }

  public static function shutDown() {
    self::$kernel->shutdown();
}}

?>
