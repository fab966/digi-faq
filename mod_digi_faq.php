<?php
defined('_JEXEC') or die;

// Per Joomla 4/5 con namespace
use Joomla\Module\DigiFaq\Site\Helper\FaqHelper; // Adatta il namespace se necessario
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Uri\Uri; // Per il percorso del CSS

// Se usi la vecchia struttura helper.php
// require_once dirname(__FILE__) . '/helper.php';

// Carica il file CSS del modulo
$document = Factory::getApplication()->getDocument();
// Il percorso URI al file CSS
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


// Recupera gli item FAQ
$faqItems = FaqHelper::getFaqItems($params); // $params è automaticamente disponibile qui

// Aggiungi lo schema JSON-LD alla head
if (!empty($faqItems)) {
    FaqHelper::addFaqSchema($faqItems);
}

// Controlla se ci sono item prima di includere il layout
if (empty($faqItems)) {
    return; // Non mostrare nulla se non ci sono FAQ
}

// Recupera il layout del modulo
require ModuleHelper::getLayoutPath('mod_digi_faq', $params->get('layout', 'default'));