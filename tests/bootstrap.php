<?php

if (!file_exists($file = __DIR__.'/../vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run test suite.');
}

$loader = require_once $file;

$loader->add('Model', __DIR__);
$loader->add('Molino', __DIR__);

/*
 * Generate Mandango model.
 */
$configClasses = array(
    'Model\Mandango\Article' => array(
        'fields' => array(
            'title' => array('type' => 'string'),
        ),
    ),
);

use Mandango\Mondator\Mondator;

$mondator = new Mondator();
$mondator->setConfigClasses($configClasses);
$mondator->setExtensions(array(
    new Mandango\Extension\Core(array(
        'metadata_factory_class'  => 'Model\Mandango\Mapping\Metadata',
        'metadata_factory_output' => __DIR__.'/Model/Mandango/Mapping',
        'default_output'          => __DIR__.'/Model/Mandango',
    )),
));
$mondator->process();
