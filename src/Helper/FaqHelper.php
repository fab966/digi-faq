<?php
/**
 * Module Digi FAQ
 * 
 * @package    	Joomla
 * @subpackage 	Modules
 * @license    	GNU/GPL, see LICENSE.php
 * @author		Fabrizio Galuppi - Digitest
 * @version		4.0.3
 * @date		Apr 2026
 * @copyright   Copyright (C) 2026 - 2030 Fabrizio Galuppi - Digitest
 * @link       	https://www.digitest.net
 */

namespace Digitest\Module\DigiFaq\Site\Helper;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

class FaqHelper
{
    public function getFaqItems(Registry $params): array
    {
        $items   = [];
        $faqData = $params->get('faq_items');

        if (empty($faqData)) {
            return $items;
        }

        if (is_string($faqData)) {
            $faqData = json_decode($faqData);
        }

        if (is_array($faqData) || is_object($faqData)) {
            foreach ($faqData as $item) {
                $items[] = (object) $item;
            }
        }

        return $items;
    }

    public function addFaqSchema(array $faqItems, \Joomla\CMS\Document\Document $doc): void
    {
        if (empty($faqItems)) {
            return;
        }

        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => []
        ];

        foreach ($faqItems as $item) {
            if (!empty($item->question) && !empty($item->answer_short)) {
                $schema['mainEntity'][] = [
                    '@type' => 'Question',
                    'name'  => htmlspecialchars(strip_tags($item->question), ENT_QUOTES, 'UTF-8'),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => nl2br(htmlspecialchars(strip_tags($item->answer_short), ENT_QUOTES, 'UTF-8'))
                    ]
                ];
            }
        }

        if (!empty($schema['mainEntity'])) {
            $doc->addScriptDeclaration(
                json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
                'application/ld+json'
            );
        }
    }
}