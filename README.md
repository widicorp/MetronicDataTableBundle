# MetronicDataTableBundle

This bundle helps to implement data source actions for [mDataTables](https://keenthemes.com/metronic/documentation.html#sec14) JavaScript plugin when it's used in [remote-type processing](https://keenthemes.com/metronic/documentation.html#sec14) mode.

## Requirements

PHP needs to be a minimum version of PHP 7.0.

Symfony must be of 2.7 or above.

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```console
composer require widicorp/metronic-datatables-bundle
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Step 2: Enable the Bundle

If you are using Symfony 3 or below, enable the bundle by adding it to the list of registered bundles in the `app/AppKernel.php` file of your project:

```php
public function registerBundles()
{
    $bundles = [
        // ...
        new Widicorp\MetronicDataTableBundle\WidicorpMetronicDatatableBundle(),
    ];
}
```

In symfony 4 this is no longer necessary :)

## Usage

Please see the complete usage example [here](../../wiki).
