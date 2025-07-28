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
$borderColor 		= $params->get('borderColor', '#444');
$questionBKG 		= $params->get('questionBKG', '#eee');
$questionBKGopen 	= $params->get('questionBKGopen', '#eee');
$answerBKG 			= $params->get('answerBKG', '#fff');


// Add CSS if requested by Module Parameter
$cssFile = Uri::base(true) . '/modules/mod_digi_faq/assets/style.css';
if($useIntCSS){$document->addStyleSheet($cssFile);};

// Customise
$customStyle = 	'.digi-faq-question{color:' . $questionColor . ';font-size:' . $questionFontSize . ';background-color:' . $questionBKG . ';}';
$customStyle .= '.digi-faq-item{border: 1px solid ' . $borderColor . ';}';
$customStyle .= '.digi-faq-answer{background-color:' . $answerBKG  . ';}';
$customStyle .= '.digi-faq-item[open] .digi-faq-question {background-color:' . $questionBKGopen . ';}';

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