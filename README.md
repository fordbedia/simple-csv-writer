# simple-csv-writer

## Installation

```
composer require fordbedia/simple-csv-writer
```

## Sample Usage

```
$csv = SimpleCSVWriter::create('testcsv');

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

```

You can also instantiate the class

```
$csv = new SimpleCSVWriter('testcsv--with-instantiation');

$arr = [
  'Row 1',
  'Row 2',
  'Row 3',
  'Row 4',
  'Row 5',
  'Row 6',
  'Row 7'
];

$csv->addRow($arr);
```