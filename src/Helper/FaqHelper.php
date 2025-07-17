<?php

namespace Joomla\Module\DigiFaq\Site\Helper;

// defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

class FaqHelper
{
    public static function getFaqItems(Registry $params): array
    {
        $items = [];
        if ($params->get('faq_items')) {
            $faqData = $params->get('faq_items');

            if (is_string($faqData)) {
                $faqData = json_decode($faqData);
            }

            if (is_array($faqData) || is_object($faqData)) {
                foreach ($faqData as $item) {
                    // Make sure item is an stdClass object if necessary
                    $items[] = (object) $item;
                }
            }
        }
        return $items;
    }

    public static function addFaqSchema(array $faqItems)
    {
        if (empty($faqItems)) {
            return;
        }

        $app = Factory::getApplication(); // Joomla 4/5
        $document = $app->getDocument();

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];

        foreach ($faqItems as $item) {
            if (!empty($item->question) && !empty($item->answer_short)) {
                $schema['mainEntity'][] = [
                    '@type' => 'Question',
                    'name' => htmlspecialchars(strip_tags($item->question), ENT_QUOTES, 'UTF-8'),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => nl2br(htmlspecialchars(strip_tags($item->answer_short), ENT_QUOTES, 'UTF-8')) // nl2br to preserve line breaks if necessary
                    ]
                ];
            }
        }

        if (!empty($schema['mainEntity'])) {
            $document->addScriptDeclaration(json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), 'application/ld+json');
        }
    }
}