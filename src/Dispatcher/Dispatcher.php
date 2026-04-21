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

namespace Digitest\Module\DigiFaq\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();
        $params = $data['params'];

        $doc = $this->getApplication()->getDocument();

        // CSS opzionale del modulo
        if ($params->get('useintcss', '1')) {
            $doc->addStyleSheet(\Joomla\CMS\Uri\Uri::base(true) . '/modules/mod_digi_faq/assets/style.css');
        }

        // CSS personalizzato dai parametri
        $customStyle  = '.digi-faq-question{color:' . $params->get('questionColor', '#444') . ';font-size:' . $params->get('questionFontSize', '1rem') . ';font-weight:' . $params->get('questionFontWeight', '400') . ';background-color:' . $params->get('questionBKG', '#eee') . ';}';
        $customStyle .= '.digi-faq-item{border: 1px solid ' . $params->get('borderColor', '#444') . ';}';
        $customStyle .= '.digi-faq-answer{background-color:' . $params->get('answerBKG', '#fff') . ';}';
        $customStyle .= '.digi-faq-item[open] .digi-faq-question {background-color:' . $params->get('questionBKGopen', '#eee') . ';}';
        $doc->addStyleDeclaration($customStyle);

        // Dati FAQ tramite Helper
        $helper   = $this->getHelperFactory()->getHelper('FaqHelper');
        $faqItems = $helper->getFaqItems($params);

        // Schema.org JSON-LD
        if (!empty($faqItems)) {
            $helper->addFaqSchema($faqItems, $doc);
        }

        $data['faqItems']       = $faqItems;
        $data['subtitle']       = $params->get('subtitle', '');
        $data['exclusive']      = $params->get('exclusive', '0');
        $data['moduleClassSfx'] = htmlspecialchars($params->get('moduleclass_sfx', ''));

        return $data;
    }
}