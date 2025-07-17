<?php
defined('_JEXEC') or die;

use Joomla\Module\DigiFaq\Site\Helper\FaqHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Uri\Uri;

// Old helper.php
// require_once dirname(__FILE__) . '/helper.php';

// Get CSS file
$document = Factory::getApplication()->getDocument();
$cssFile = Uri::base(true) . '/modules/mod_digi_faq/assets/style.css';

// Get Params
$subtitle 			= $params->get('subtitle', '');
$useIntCSS 			= $params->get('useintcss', '1');
$questionColor 		= $params->get('questionColor', '#444'); 
$questionFontSize 	= $params->get('questionFontSize', '1rem');

// Add CSS if requested by Module Parameter
$cssFile = Uri::base(true) . '/modules/mod_digi_faq/assets/style.css';
if($useIntCSS){$document->addStyleSheet($cssFile);};

// Customise
$customStyle = '.digi-faq-question{color:'.$questionColor.';font-size:'.$questionFontSize.';}';
$document->addStyleDeclaration($customStyle);


// Get FAQ Items
$faqItems = FaqHelper::getFaqItems($params);

// Add JSON-LD to the Head
if (!empty($faqItems)) {
    FaqHelper::addFaqSchema($faqItems);
}

// Check if there are Items
if (empty($faqItems)) {
    return;
}

// Module Layout
require ModuleHelper::getLayoutPath('mod_digi_faq', $params->get('layout', 'default'));