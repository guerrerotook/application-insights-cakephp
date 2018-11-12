# Application Insights plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

Get more information in [Packagist](https://packagist.org/packages/guerrerotook/application-insights-cakephp)

```
composer require guerrerotook/application-insights-cakephp 
```
## Information

This plugin will help you integreate request and exception information to CakePHP middleware API. It's automatically logs any exceptions during the process a request and the request information also. 

You need to setup a new configuration setting to set the Application Inisights Instrumentation Key.

Go to you config/app.php and add this section

`'ApplicationInsights' => [
        'InstrumentationKey' => '{InstrumentationValue}'
    ]`