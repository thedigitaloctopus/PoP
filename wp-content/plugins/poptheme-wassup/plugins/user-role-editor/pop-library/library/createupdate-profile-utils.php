<?php
/**---------------------------------------------------------------------------------------------------------------
 *
 * Data Load Library
 *
 * ---------------------------------------------------------------------------------------------------------------*/

class GD_URE_CreateUpdate_Profile_Utils {

	public static function get_form_data($atts) {

		// Comment Leo 05/12/2016: LinkedIn is removed from AgendaUrbana, however we don't check for the condition here, so it will still get null
		global $gd_template_processor_manager;
		return array(
			'facebook' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_FACEBOOK)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_FACEBOOK, $atts)),
			'twitter' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_TWITTER)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_TWITTER, $atts)),
			'linkedin' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_LINKEDIN)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_LINKEDIN, $atts)),
			'youtube' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_YOUTUBE)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_YOUTUBE, $atts)),
			'instagram' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_INSTAGRAM)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_INSTAGRAM, $atts)),
			'blog' => trim($gd_template_processor_manager->get_processor(GD_TEMPLATE_FORMCOMPONENT_CUP_BLOG)->get_value(GD_TEMPLATE_FORMCOMPONENT_CUP_BLOG, $atts)),
		);		
	}

	public static function createupdateuser($user_id, $form_data) {

		// Comment Leo 05/12/2016: LinkedIn is removed from AgendaUrbana, however we don't check for the condition here, so it will still save null
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_FACEBOOK, $form_data['facebook'], true);
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_TWITTER, $form_data['twitter'], true);
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_LINKEDIN, $form_data['linkedin'], true);
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_YOUTUBE, $form_data['youtube'], true);
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_INSTAGRAM, $form_data['instagram'], true);
		GD_MetaManager::update_user_meta($user_id, GD_METAKEY_PROFILE_BLOG, $form_data['blog'], true);
	}
}