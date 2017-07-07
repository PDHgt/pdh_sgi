dompdfmodule
============

DOMPDF library wrapper as lightweight ZF2/ZF3 module.

## Requirements
  - [Zend Framework 2 or 3](https://framework.zend.com/)

## Installation
Installation of DOMPDFModule uses PHP Composer. For more information about
PHP Composer, please visit the official [PHP Composer site](http://getcomposer.org/).

#### Installation steps

  1. `cd my/project/directory`
  2. create a `composer.json` file with following contents:

     ```json
     {
         "require": {
             "mikemix/dompdfmodule": "^2.0"
         }
     }
     ```
  3. install PHP Composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  4. run `php composer.phar install`
  5. open `my/project/directory/config/application.config.php` and add the following key to your `modules`: 

     ```php
     'dompdfmodule',
     ```

#### Configuration options
You can override default options via the `dompdf` key in your local or global config files. See the [dompdfmoule\Service\dompdfFactory.php](https://github.com/mikemix/dompdfmodule/blob/master/src/dompdfmodule/Service/dompdfFactory.php#L39) file for the list of default settings.

Full list of possible settings is available at the official [DOMPDF library](https://github.com/dompdf/dompdf) site.

#### Example usage

```php
<?php

// some controller

    public function indexAction()
    {
        /** @var \DOMPDF $dompdf */
        $dompdf = $this->getServiceLocator()->get('dompdf');
        $dompdf->load_html('<strong>Ehlo World</strong>');
        $dompdf->render();

        file_put_contents(__DIR__ . '/document.pdf', $dompdf->output());
    }
```
