<?php
/**
 * Module Digi FAQ
 * 
 * @package    	Joomla
 * @subpackage 	Modules
 * @license    	GNU/GPL, see LICENSE.php
 * @author		Fabrizio Galuppi - Digitest
 * @version		4.0.2
 * @date		Mar 2026
 * @copyright   Copyright (C) 2026 - 2030 Fabrizio Galuppi - Digitest
 * @link       	https://www.digitest.net
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container->registerServiceProvider(
            new ModuleDispatcherFactory('\\Digitest\\Module\\DigiFaq')
        );
        $container->registerServiceProvider(
            new HelperFactory('\\Digitest\\Module\\DigiFaq\\Site\\Helper')
        );
        $container->registerServiceProvider(new Module());
    }
};