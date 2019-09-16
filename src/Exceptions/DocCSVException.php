<?php
namespace SimpleCSVWriter\Exceptions;

use Exception;

class DocCSVException extends Exception {
  
  protected $message, $code;
  
  public function __construct($message, $code = 0, Exception $prev = null)
  {
    $this->message = $message;
    $this->code = $code;
    
    parent::__construct($message, $code, $prev);
  }
  
  public function message()
  {
    return $this->message;
  }
  
  public function code()
  {
    return $this->code;
  }
  
}