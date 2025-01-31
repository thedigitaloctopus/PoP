<?php
use PoPCMSSchema\CustomPosts\Types\Status;

class UserStance_Module_Processor_ButtonWrappers extends PoP_Module_Processor_ConditionWrapperBase
{
    public final const COMPONENT_BUTTONWRAPPER_STANCEVIEW = 'buttonwrapper-stanceview';

    /**
     * @return string[]
     */
    public function getComponentNamesToProcess(): array
    {
        return array(
            self::COMPONENT_BUTTONWRAPPER_STANCEVIEW,
        );
    }

    public function getConditionSucceededSubcomponents(\PoP\ComponentModel\Component\Component $component)
    {
        $ret = parent::getConditionSucceededSubcomponents($component);

        switch ($component->name) {
            case self::COMPONENT_BUTTONWRAPPER_STANCEVIEW:
                $ret[] = [UserStance_Module_Processor_Buttons::class, UserStance_Module_Processor_Buttons::COMPONENT_BUTTON_STANCEVIEW];
                break;
        }

        return $ret;
    }

    public function getConditionField(\PoP\ComponentModel\Component\Component $component): ?string
    {
        switch ($component->name) {
            case self::COMPONENT_BUTTONWRAPPER_STANCEVIEW:
                return /* @todo Re-do this code! Left undone */ new Field('isStatus', ['status' => Status::PUBLISHED], 'published');
        }

        return null;
    }
}



