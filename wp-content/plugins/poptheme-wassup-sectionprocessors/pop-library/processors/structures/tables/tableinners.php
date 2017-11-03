<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Manager (Handlebars)
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_TABLEINNER_MYANNOUNCEMENTS', PoP_TemplateIDUtils::get_template_definition('tableinner-myannouncements'));
define ('GD_TEMPLATE_TABLEINNER_MYDISCUSSIONS', PoP_TemplateIDUtils::get_template_definition('tableinner-mydiscussions'));
define ('GD_TEMPLATE_TABLEINNER_MYLOCATIONPOSTS', PoP_TemplateIDUtils::get_template_definition('tableinner-mylocationposts'));
define ('GD_TEMPLATE_TABLEINNER_MYSTORIES', PoP_TemplateIDUtils::get_template_definition('tableinner-mystories'));

class GD_Custom_Template_Processor_TableInners extends GD_Template_Processor_TableInnersBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_TABLEINNER_MYANNOUNCEMENTS,
			GD_TEMPLATE_TABLEINNER_MYDISCUSSIONS,
			GD_TEMPLATE_TABLEINNER_MYLOCATIONPOSTS,
			GD_TEMPLATE_TABLEINNER_MYSTORIES,
		);
	}

	function get_layouts($template_id) {

		$ret = parent::get_layouts($template_id);

		// Main layout
		switch ($template_id) {

			case GD_TEMPLATE_TABLEINNER_MYANNOUNCEMENTS:

				$ret[] = GD_TEMPLATE_LAYOUT_PREVIEWPOST_ANNOUNCEMENT_EDIT;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_DATE;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_STATUS;
				break;

			case GD_TEMPLATE_TABLEINNER_MYDISCUSSIONS:

				$ret[] = GD_TEMPLATE_LAYOUT_PREVIEWPOST_DISCUSSION_EDIT;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_DATE;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_STATUS;
				break;

			case GD_TEMPLATE_TABLEINNER_MYLOCATIONPOSTS:

				$ret[] = GD_TEMPLATE_LAYOUT_PREVIEWPOST_LOCATIONPOST_EDIT;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_DATE;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_STATUS;
				break;

			case GD_TEMPLATE_TABLEINNER_MYSTORIES:

				$ret[] = GD_TEMPLATE_LAYOUT_PREVIEWPOST_STORY_EDIT;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_DATE;
				$ret[] = GD_TEMPLATE_LAYOUTPOST_STATUS;
				break;
		}

		return $ret;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_Custom_Template_Processor_TableInners();