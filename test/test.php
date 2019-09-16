<?php

use SimpleCSVWriter\SimpleCSVWriter;

// $csv = SimpleCSVWriter::create('testcsv');
$csv = new SimpleCSVWriter('testcsv--with-instantiation');

$csv->addRow('<br>');

$csv->addHeader('This is a test header');

$csv->addHeadColumn([
  'Header 1',
  'Header 2',
  'Header 3',
  'Header 4',
  'Header 5',
  'Header 6',
  'Header 7'
]);

$csv->addRow('break');
$csv->addRow('<br>');

$csv->addRow([
  'Row 1',
  'Row 2',
  'Row 3',
  'Row 4',
  'Row 5',
  'Row 6',
  'Row 7'
]);


$csv->close();