<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Template Configuration
 *
 * ---------------------------------------------------------------------------------------------------------------*/

define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-navigator'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-addons'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-details'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-thumbnail'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-list'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-mapdetails'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-popover'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-communities'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organization-postauthor'));

// define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-organizationmembers-list'));

define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-organization-details'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-organization-thumbnail'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-organization-list'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-organization-mapdetails'));

define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-navigator'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-addons'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-details'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-thumbnail'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-list'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-mapdetails'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-popover'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-communities'));
define ('GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR', PoP_TemplateIDUtils::get_template_definition('layout-previewuser-individual-postauthor'));

define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-individual-details'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-individual-thumbnail'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-individual-list'));
define ('GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS', PoP_TemplateIDUtils::get_template_definition('layout-authorpreviewuser-individual-mapdetails'));

class GD_URE_Template_Processor_CustomPreviewUserLayouts extends GD_Template_Processor_CustomPreviewUserLayoutsBase {

	function get_templates_to_process() {
	
		return array(
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR,
			// GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES,
			GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST,
			GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS,
		);
	}

	function get_quicklinkgroup_top($template_id) {

		switch ($template_id) {

			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST:

				return GD_TEMPLATE_QUICKLINKGROUP_USER;
		}

		return parent::get_quicklinkgroup_top($template_id);
	}	

	function get_title_htmlmarkup($template_id, $atts) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:

				return 'h3';
		}

		return parent::get_title_htmlmarkup($template_id, $atts);
	}	

	function get_quicklinkgroup_bottom($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST:

				return GD_TEMPLATE_QUICKLINKGROUP_USERBOTTOM;
		}

		return parent::get_quicklinkgroup_bottom($template_id);
	}	

	// function get_extra_class($template_id) {

	// 	switch ($template_id) {

	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:

	// 			return 'bg-info text-info belowavatar';
	// 	}

	// 	return parent::get_extra_class($template_id);
	// }

	function get_belowexcerpt_layouts($template_id) {

		$ret = parent::get_belowexcerpt_layouts($template_id);

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:

				$ret[] = GD_TEMPLATE_VIEWCOMPONENT_BUTTONWRAPPER_USERLOCATIONS;
				break;

			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:

				$ret[] = GD_URE_TEMPLATE_LAYOUTUSER_MEMBERTAGS;			
				$ret[] = GD_TEMPLATE_VIEWCOMPONENT_BUTTONWRAPPER_USERLOCATIONS;
				break;

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:

				$ret[] = GD_TEMPLATE_MULTICOMPONENT_ORGANIZATIONDETAILS;
				$ret[] = GD_URE_TEMPLATE_LAYOUTWRAPPER_ORGANIZATIONMEMBERS;
				break;
		
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST:

			// 	$ret[] = GD_URE_TEMPLATE_LAYOUT_ORGANIZATIONMEMBERS;
			// 	break;
		}

		return $ret;
	}

	function get_belowavatar_layouts($template_id) {

		$ret = parent::get_belowavatar_layouts($template_id);

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:

				$ret[] = GD_TEMPLATE_VIEWCOMPONENT_BUTTONWRAPPER_USERLOCATIONS;
				break;

			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:

				$ret[] = GD_URE_TEMPLATE_LAYOUTUSER_MEMBERTAGS;			
				$ret[] = GD_TEMPLATE_VIEWCOMPONENT_BUTTONWRAPPER_USERLOCATIONS;
				break;
		}

		return $ret;
	}

	function get_useravatar_template($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST:

				return GD_TEMPLATE_LAYOUT_USERAVATAR_40;

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER:

				return GD_TEMPLATE_LAYOUT_USERAVATAR_60;

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			
				return GD_TEMPLATE_LAYOUT_USERAVATAR_120_RESPONSIVE;

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:

				return GD_TEMPLATE_LAYOUT_USERAVATAR_150_RESPONSIVE;
		}

		return parent::get_useravatar_template($template_id);
	}


	function show_excerpt($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:

				return true;
		}

		return parent::show_excerpt($template_id);
	}

	// function show_short_description($template_id) {

	// 	switch ($template_id) {

	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
	// 		case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
	// 		case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			
	// 			return false;
	// 	}

	// 	return parent::show_short_description($template_id);
	// }

	function horizontal_layout($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:

				return true;
		}

		return parent::horizontal_layout($template_id);
	}

	function horizontal_media_layout($template_id) {

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS:

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_LIST:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATIONMEMBERS_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_LIST:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_LIST:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_LIST:

				return true;
		}

		return parent::horizontal_media_layout($template_id);
	}

	function get_template_configuration($template_id, $atts) {

		$ret = parent::get_template_configuration($template_id, $atts);

		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_POSTAUTHOR:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_NAVIGATOR:
			// case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_ADDONS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POPOVER:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_COMMUNITIES:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_POSTAUTHOR:

				$ret[GD_JS_CLASSES/*'classes'*/]['quicklinkgroup-bottom'] = 'icon-only pull-right';
				break;
		}
		switch ($template_id) {

			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_ORGANIZATION_THUMBNAIL:			
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_DETAILS:
			case GD_TEMPLATE_LAYOUT_AUTHORPREVIEWUSER_INDIVIDUAL_THUMBNAIL:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_ORGANIZATION_MAPDETAILS:
			case GD_TEMPLATE_LAYOUT_PREVIEWUSER_INDIVIDUAL_MAPDETAILS:

				$ret[GD_JS_CLASSES/*'classes'*/]['belowavatar'] = 'bg-info text-info belowavatar';
				break;
		}

		return $ret;
	}
}

/**---------------------------------------------------------------------------------------------------------------
 * Initialization
 * ---------------------------------------------------------------------------------------------------------------*/
new GD_URE_Template_Processor_CustomPreviewUserLayouts();