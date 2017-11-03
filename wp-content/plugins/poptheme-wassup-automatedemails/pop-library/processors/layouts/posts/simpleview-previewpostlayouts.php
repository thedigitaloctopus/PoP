<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Configuration
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_LAYOUT_AUTOMATEDEMAILS_PREVIEWPOST_POST_SIMPLEVIEW', PoP_TemplateIDUtils::get_template_definition('layout-automatedemails-previewpost-post-simpleview'));

class PoPTheme_Wassup_AE_Template_Processor_SimpleViewPreviewPostLayouts extends GD_Template_Processor_BareSimpleViewPreviewPostLayoutsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_LAYOUT_AUTOMATEDEMAILS_PREVIEWPOST_POST_SIMPLEVIEW,
		);
	}


	function get_author_template($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_AUTOMATEDEMAILS_PREVIEWPOST_POST_SIMPLEVIEW:

				return GD_TEMPLATE_LAYOUTPOST_AUTHORNAME;
		}

		return parent::get_author_template($template_id);
	}

	function get_abovecontent_layouts($template_id) {

		$ret = parent::get_abovecontent_layouts($template_id);

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_AUTOMATEDEMAILS_PREVIEWPOST_POST_SIMPLEVIEW:

				$ret[] = GD_TEMPLATE_LAYOUT_MULTIPLEPOST_SIMPLEVIEW_CUSTOMLAYOUTS;
				break;
		}

		return $ret;
	}

	function get_aftercontent_layouts($template_id) {

		$ret = parent::get_aftercontent_layouts($template_id);

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_AUTOMATEDEMAILS_PREVIEWPOST_POST_SIMPLEVIEW:

				$ret[] = GD_TEMPLATE_QUICKLINKBUTTONGROUP_COMMENTS_LABEL;
				break;
		}

		return $ret;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new PoPTheme_Wassup_AE_Template_Processor_SimpleViewPreviewPostLayouts();