<?php
use PoP\Root\Facades\Translation\TranslationAPIFacade;

class PoP_ContactUs_Module_Processor_GFForms extends PoP_Module_Processor_FormsBase
{
    public final const COMPONENT_FORM_CONTACTUS = 'form-contactus';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_FORM_CONTACTUS,
        );
    }

    public function getInnerSubcomponent(\PoP\ComponentModel\Component\Component $component)
    {
        $inners = array(
            self::COMPONENT_FORM_CONTACTUS => [PoP_ContactUs_Module_Processor_GFFormInners::class, PoP_ContactUs_Module_Processor_GFFormInners::COMPONENT_FORMINNER_CONTACTUS],
        );

        if ($inner = $inners[$component->name] ?? null) {
            return $inner;
        }

        return parent::getInnerSubcomponent($component);
    }

    public function initModelProps(\PoP\ComponentModel\Component\Component $component, array &$props): void
    {
        switch ($component->name) {
            case self::COMPONENT_FORM_CONTACTUS:
                $email = '';
                if (defined('POP_EMAILSENDER_INITIALIZED')) {
                    $email = PoP_EmailSender_Utils::getFromEmail();
                }
                if ($email = \PoP\Root\App::applyFilters(
                    'PoP_Module_Processor_GFForms:contactus:email',
                    $email
                )
                ) {
                     // Add the description. Allow Organik Fundraising to override the message
                    $description = sprintf(
                        '<p><em>%s</em></p>',
                        \PoP\Root\App::applyFilters(
                            'PoP_Module_Processor_GFForms:contactus:description',
                            sprintf(
                                TranslationAPIFacade::getInstance()->__('Please write an email to <a href="mailto:%1$s">%1$s</a>, or fill in the form below:', 'pop-genericforms'),
                                $email
                            ),
                            $email
                        )
                    );
                    $this->setProp($component, $props, 'description', $description);
                }
                break;
        }

        parent::initModelProps($component, $props);
    }
}



