<?php
// Per Joomla 4/5 con namespace
namespace Joomla\Module\DigiFaq\Site\Helper; // Adatta il namespace al tuo modulo

// Se usi la vecchia struttura senza namespace (helper.php)
// defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

class FaqHelper
{
    public static function getFaqItems(Registry $params): array
    {
        $items = [];
        if ($params->get('faq_items')) {
            // Il subform salva i dati come stringa JSON, quindi decodificali
            // In Joomla 4/5, il subform potrebbe già restituire un array di oggetti/array
            $faqData = $params->get('faq_items');

            // Controlla se è già un array/oggetto o una stringa JSON
            if (is_string($faqData)) {
                $faqData = json_decode($faqData);
            }

            if (is_array($faqData) || is_object($faqData)) {
                foreach ($faqData as $item) {
                    // Assicurati che item sia un oggetto stdClass se necessario
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

        $app = Factory::getApplication(); // Per Joomla 4/5
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
                        'text' => nl2br(htmlspecialchars(strip_tags($item->answer_short), ENT_QUOTES, 'UTF-8')) // nl2br per preservare le interruzioni di riga se necessario
                    ]
                ];
            }
        }

        if (!empty($schema['mainEntity'])) {
            // Utilizza addScriptDeclaration per aggiungere JSON-LD
            $document->addScriptDeclaration(json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), 'application/ld+json');
        }
    }
}