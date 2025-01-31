<?php
use PoPCMSSchema\CustomPosts\Types\Status;

abstract class PoP_Module_Processor_FullViewTitleLayoutsBase extends PoP_Module_Processor_FullObjectTitleLayoutsBase
{
    public function getTitleField(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        return 'title';
    }

    public function getTitleattrField(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        return 'alt';
    }

    public function getTitleConditionField(\PoP\ComponentModel\Component\Component $component, array &$props)
    {
        return /* @todo Re-do this code! Left undone */ new Field('isStatus', ['status' => Status::PUBLISHED], 'published');
    }
}
