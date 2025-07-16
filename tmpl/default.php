<?php
defined('_JEXEC') or die;


use Joomla\CMS\Language\Text;

// Classe CSS principale per il modulo (puoi anche usare $module->id per un ID univoco)
$containerClass = 'mod_digifaq_container ' . $moduleClassSfx;
?>
<div class="<?php echo trim($containerClass); ?>">
   
	<?php echo $subtitle ? '<h4>'.$subtitle.'</h4>' : ''; ?>
   
   
   
    <?php if (!empty($faqItems)) : ?>
        <div class="faq-list">
            <?php foreach ($faqItems as $index => $item) : ?>
                <?php if (!empty($item->question) && !empty($item->answer_long)) : ?>
                    <details class="digi-faq-item" id="faq-item-<?php echo $module->id . '-' . $index; ?>">
                        <summary class="digi-faq-question">
                            <?php echo htmlspecialchars($item->question); ?>
                        </summary>
                        <div class="digi-faq-answer">
                            <?php echo $item->answer_long; // JHtml::_('content.prepare', $item->answer) se vuoi processare i plugin di contenuto ?>
                        </div>
                    </details>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Nessuna domanda trovata</p>
    <?php endif; ?>
</div>