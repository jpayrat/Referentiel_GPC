<?php

namespace RefGPC\_systemClass;

/**
 * Gestion des exceptions de l'application
 */

class RefGpcException extends \Exception {
  
  public function __construct($message, $code = 0) {
    parent::__construct($message, $code);
  }
  
  public function __toString() {
    return $this->message;
  }   
  
}
