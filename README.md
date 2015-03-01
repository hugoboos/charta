Charta
======

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Quality Score](https://img.shields.io/scrutinizer/g/hugoboos/charta.svg?style=flat-square)](https://scrutinizer-ci.com/g/hugoboos/charta)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/63e4120c-e7db-48d4-8acf-faee1dfb007a/mini.png)](https://insight.sensiolabs.com/projects/63e4120c-e7db-48d4-8acf-faee1dfb007a)

**Charta** is a CLI tool to add geolocations to address.


Installation
------------

Install the dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```


Usage
-----

```bash
$ bin/carta convert <input file> <output file>
```

Currently only a CSV as ```<input file>``` is supported, and a JSON file as ```<output file>```. 


CSV file format
----------

```csv
<Name>;<Street>;<Postal code>;<City>
```

JSON file format
----------------

```json
{
  "Name": "<Name>",
  "Address": {
    "Street": "<Street>",
    "PostalCode": "<Postal code>",
    "City": "<City>",
    "Geo": {
      "Lat": 123,
      "Lng": 456
    }
  }
}
```


License
-------

Charta is released under the MIT License.
