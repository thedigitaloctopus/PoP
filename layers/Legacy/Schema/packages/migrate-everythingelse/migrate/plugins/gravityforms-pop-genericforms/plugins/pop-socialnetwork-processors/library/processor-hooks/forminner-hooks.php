<?php

class PoP_SocialNetwork_Module_Processor_GFFormInnerHooks
{
    public function __construct()
    {
        \PoP\Root\App::addAction(
            'PoP_Module_Processor_GFFormInners:init-props',
            $this->initModelProps(...),
            10,
            3
        );
        \PoP\Root\App::addFilter(
            'PoP_Module_Processor_GFFormInners:layouts',
            $this->getLayoutSubmodules(...),
            10,
            2
        );
    }

    public function getLayoutSubmodules($layouts, array $module)
    {
        switch ($module[1]) {
            case PoP_SocialNetwork_Module_Processor_GFFormInners::MODULE_FORMINNER_CONTACTUSER:
                $layouts[] = [GD_GF_Module_Processor_TextFormInputs::class, GD_GF_Module_Processor_TextFormInputs::MODULE_GF_FORMINPUT_FORMID];
                break;
        }
        
        return $layouts;
    }

    public function initModelProps(array $module, $props_in_array, $processor)
    {
        $props = &$props_in_array[0];
        switch ($module[1]) {
            case PoP_SocialNetwork_Module_Processor_GFFormInners::MODULE_FORMINNER_CONTACTUSER:
                // Form ID
                $form_id = PoP_SocialNetwork_GFHelpers::getContactuserFormId();
                $processor->setProp([GD_GF_Module_Processor_TextFormInputs::class, GD_GF_Module_Processor_TextFormInputs::MODULE_GF_FORMINPUT_FORMID], $props, 'default-value'/*'selected-value'*/, $form_id);
                break;
        }
    }
}



