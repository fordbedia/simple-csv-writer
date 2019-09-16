<?php
namespace SimpleCSVWriter;

use SimpleCSVWriter\Exceptions\DocsCSVException;

class SimpleCSVWriter extends Writer { 
  
  public function __construct($filename)
  {
    self::create($filename);
  }
  
}
