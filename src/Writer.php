<?php
namespace SimpleCSVWriter;

use SimpleCSVWriter\Exceptions\DocCSVException;

class Writer {
  
   /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected static $handle;

  /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected static $instance;

  /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected static $filename = 'dmr.csv';

  /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected $pointer;

  /**
   * Undocumented variable
   *
   * @var array
   */
  protected $headers = [
    'Cache-Control'               => 'must-revalidate, post-check=0, pre-check=0',
    'Content-type'                => 'text/csv',
    'Expires'                     => '0',
    'Pragma'                      => 'public',
    'Content-Type'                => 'application/force-download',
    'Content-Type'                => 'application/octet-stream',
    'Content-Tylastpe'            => 'application/download',
    'Content-Transfer-Encoding'   => 'binary'
    ];
  
  /**
   * Undocumented function
   *
   * @param [type] $filename
   * @return void
   */
  public static function create($filename)
  {
    ob_start();
    self::$filename = $filename;
    self::$instance = new self();
    self::$handle = fopen("php://output", 'w');

    return self::$instance;
  }
  
    /**
   * Undocumented function
   *
   * @param array $arr
   * @return void
   */
  public function addHeadColumn(array $arr = [])
  {
    $this->pointer = $this->write($arr);

    return $this;
  }

  /**
   * Undocumented function
   *
   * @param array $arr
   * @return void
   */
  public function addRow($arr = [])
  {
    $this->pointer = $this->write($this->translate($arr));

    return $this;
  }

  /**
   * Undocumented function
   *
   * @param mixed $item
   * @return $this
   */
  public function addHeader($item)
  {
    $this->pointer = $this->write($this->getArrayableItems($item));

    return $this;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function close()
  {
    fclose(self::$handle);
    $this->addHeaders($this->headers);
    ob_flush();
  }

  /**
   * Undocumented function
   *
   * @param [type] $items
   * @return void
   */
  protected function getArrayableItems($items)
  {
    if (is_array($items)) {
      return $items;
    }
    if (is_string($items)) {
      return [$items];
    }
    
    throw new DocCSVException('Iterable item is not recognize. Please consider array or string');
  }

  /**
   * Undocumented function
   *
   * @param array $headers
   * @return void
   */
  protected function addHeaders(array $headers = [])
  {
    foreach(array_replace($headers, [
      'Content-Disposition' => 'attachment; filename='.self::$filename.'.csv',
    ]) as $type => $header) {
      header($type.':'.$header);
    }
  }

  /**
   * Undocumented function
   *
   * @param array $arr
   * @return void
   */
  protected function write($arr = [])
  {
    fputcsv(self::$handle, $arr);
  }

  /**
   * Undocumented function
   *
   * @param [type] $exprss
   * @return void
   */
  protected function translate($exprss)
  {
    if (is_string($exprss)) {
      preg_match('/^(<br \/>|<br>|br|break)$/', $exprss, $o);
      if (count($o)) {
        return ["\r\n"];
      }
      throw new DocCSVException($exprss . ' is not a valid expression. For string, please consider using addHeader()');
    }
    if (is_array($exprss)) {
      return $exprss;
    }
    throw new DocCSVException($exprss . ' is not a valid expression. For string, please consider using addHeader()');
  }
  
}