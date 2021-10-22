<img src="https://static.openpay.com.au/brand/logo/openpay_logo_transparent.svg" width="170" alt="Openpay Logo">

Introduction
---------

### Objectives and Target Audience

This guide describes the process of installing and configuring the Openpay Widget / Extension to Magento 2.X. You should have an existing Magento installed.

Widgets explain how Openpay is a flexible, interest-free payment method. It showcases the minimum and maximum order value, allowing the user to choose an option to pay weekly or fortnightly, over available months.


### What is Openpay Widget?
Openpay Widgets is a Magento Extension with a predefined set of configuration options.

### Placement of the Widgets

Openpay Widget plugin is a set of widgets, when installed and activated will show the widgets on the following pages:

- Info Belt – Top section of the HomePage
- Product Catalog / Listing Page
- Product Detail Page
- Cart Page
- Checkout Page
- Landing Page

Compatibility
---------
- PHP 5.6 or later
- Magento 2.x to 2.4.X


Requirements
---------
- At least 5.6 or the later version of PHP
- cURL extension for PHP
- JSON extension for PHP
- Multibyte String extension for PHP
- Magento should be pre-installed on your web server. The extension has been tested on Magento version 2.x to 2.4.X
- SSL: A valid security certificate is required to work over a secure channel (HTTPS) from the Magento Admin Panel or while submitting the form data from the storefront. Self-signed SSL certificates are not supported
- Curl (version 7.20.0 - 7.4.0)

[Magento 2.3 technology stack requirements](https://devdocs.magento.com/guides/v2.3/install-gde/system-requirements.html)

[Magento 2.4 system requirements](https://devdocs.magento.com/guides/v2.4/install-gde/system-requirements.html)


Installation
---------

### Composer

Use [composer](https://getcomposer.org) to install the Openpay payment module. Follow the [installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require opy/widgets
```


Using server SSH Access, please go to project root folder and run the following commands to ensure the configuration tasks are run, database schema is updated and Magento's cache is cleared.

- php bin/magento setup:upgrade

- php bin/magento setup:static-content:deploy -f

- php bin/magento cache:flush

Or, you can do it manually from the admin by following the path: `System` > `Tools` > `Cache Management` and then clicking on the `Flush Magento Cache` button.

#### Important note

Please make sure you have already installed the Openpay payment plugin to make the widgets work as expected.

Admin Setup
---------

In the backend, expand `Openpay  Widgets -> General Configuration -> Enable Widgets -> Yes -> Save Config`

To set up `Openpay Widgets`, fill out the fields as per your Openpay account configuration. (This information will be provided by your Openpay Ecommerce Manager or Account Manager).


###### Command to run the Payment Plugin:

```sh
composer require opy/module-payment
``` 

Check with Openpay / Ecommerce Manager for your Plan Tiers configuration.
