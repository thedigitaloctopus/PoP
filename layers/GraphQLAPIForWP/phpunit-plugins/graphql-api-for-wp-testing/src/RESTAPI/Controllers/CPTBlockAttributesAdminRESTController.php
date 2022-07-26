<?php

declare(strict_types=1);

namespace PHPUnitForGraphQLAPI\GraphQLAPITesting\RESTAPI\Controllers;

use Exception;
use GraphQLAPI\GraphQLAPI\Constants\ModuleSettingOptions;
use GraphQLAPI\GraphQLAPI\Facades\Registries\ModuleRegistryFacade;
use GraphQLAPI\GraphQLAPI\Facades\UserSettingsManagerFacade;
use GraphQLAPI\GraphQLAPI\ModuleSettings\Properties;
use PHPUnitForGraphQLAPI\GraphQLAPITesting\RESTAPI\Constants\Params;
use PHPUnitForGraphQLAPI\GraphQLAPITesting\RESTAPI\Constants\ResponseStatus;
use PHPUnitForGraphQLAPI\GraphQLAPITesting\RESTAPI\Response\ResponseKeys;
use PHPUnitForGraphQLAPI\GraphQLAPITesting\RESTAPI\RESTResponse;
use WP_Error;
use WP_Post;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

use function get_post;
use function rest_ensure_response;
use function rest_url;

/**
 * Visualize and modify the attributes of a block inside a custom post, including:
 *
 * - Schema Configurators
 * - Custom Endpoints
 * - Persisted Queries
 * - ACLs
 * - CCLs
 */
class CPTBlockAttributesAdminRESTController extends AbstractAdminRESTController
{
    use WithFlushRewriteRulesRESTControllerTrait;

    protected string $restBase = 'cpt-block-attributes';

    /**
     * @return array<string,array<array<string,mixed>>> Array of [$route => [$options]]
     */
    protected function getRouteOptions(): array
    {
        return [
            $this->restBase . '/(?P<customPostID>[\d]+)' => [
                [
                    'methods' => WP_REST_Server::READABLE,
                    'callback' => $this->retrieveAllItems(...),
                    // Allow anyone to read the modules
                    'permission_callback' => '__return_true',
                    'args' => [
                        Params::CUSTOM_POST_ID => $this->getCustomPostIDParamArgs(),
                    ],
                ],
            ],
            // $this->restBase . '/(?P<customPostID>[\d]+)/(?P<blockID>[a-zA-Z_-]+)' => [
            //     [
            //         'methods' => WP_REST_Server::READABLE,
            //         'callback' => $this->retrieveItem(...),
            //         // Allow anyone to read the modules
            //         'permission_callback' => '__return_true',
            //         'args' => [
            //             Params::CUSTOM_POST_ID => $this->getCustomPostIDParamArgs(),
            //             Params::BLOCK_ID => $this->getBlockIDParamArgs(),
            //         ],
            //     ],
            //     [
            //         'methods' => WP_REST_Server::CREATABLE,
            //         'callback' => $this->updateItem(...),
            //         // only the Admin can execute the modification
            //         'permission_callback' => $this->checkAdminPermission(...),
            //         'args' => [
            //             Params::CUSTOM_POST_ID => $this->getCustomPostIDParamArgs(),
            //             Params::BLOCK_ID => $this->getBlockIDParamArgs(),
            //             Params::BLOCK_ATTRIBUTE_VALUES => [
            //                 'description' => __('Array of [\'attribute\' => \'value\']. Different blocks can normally contain different attributes', 'graphql-api-testing'),
            //                 'type' => 'object',
            //                 // 'properties' => [
            //                 //     'attribute'  => [
            //                 //         'type' => 'string',
            //                 //         'required' => true,
            //                 //     ],
            //                 //     'value' => [
            //                 //         'required' => true,
            //                 //     ],
            //                 // ],
            //                 'required' => true,
            //             ],
            //         ],
            //     ],
            // ],
        ];
    }

    /**
     * @return array<string,mixed>
     */
    protected function getCustomPostIDParamArgs(): array
    {
        return [
            'description' => __('Custom Post ID', 'graphql-api-testing'),
            'type' => 'integer',
            'required' => true,
            'validate_callback' => $this->validateCustomPost(...),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    protected function getBlockIDParamArgs(): array
    {
        return [
            'description' => __('Block ID, composed as "blockName:number", where ":number" defaults to ":0" (i.e. either first or only block with that name)', 'graphql-api-testing'),
            'type' => 'string',
            'required' => true,
        ];
    }

    /**
     * Validate there is a custom post with this ID
     */
    protected function validateCustomPost(string $customPostID): bool|WP_Error
    {
        $post = $this->getCustomPost((int)$customPostID);
		if (is_wp_error($post)) {
			return $post;
		}
        return true;
    }

	/**
	 * Get the post, if the ID is valid.
	 *
	 * @since 4.7.2
	 *
	 * @param int $id Supplied ID.
	 * @return WP_Post|WP_Error Post object if ID is valid, WP_Error otherwise.
     *
     * Function copied from WordPress core.
     *
     * @see wp-includes/rest-api/endpoints/class-wp-rest-posts-controller.php
	 */
	protected function getCustomPost(int $customPostID): WP_Post|WP_Error
    {
		if ($customPostID <= 0) {
            return new WP_Error(
                'rest_post_invalid_id',
                __('Invalid custom post ID', 'graphql-api-testing'),
                [
                    Params::STATE => $customPostID,
                ]
            );
		}

		$post = get_post($customPostID);
		if (empty($post) || empty($post->ID)) {
			return new WP_Error(
                'rest_post_invalid_id',
                sprintf(
                    __('There is no custom post with ID \'%s\'', 'graphql-api-testing'),
                    $customPostID
                ),
                [
                    Params::STATE => $customPostID,
                ]
            );
		}

		if (!in_array($post->post_type, $this->supportedCustomPostTypes)) {
			return new WP_Error(
                'rest_post_invalid_id',
                sprintf(
                    __('Custom post is of unsupported custom post type \'%s\' (supported custom post types are: \'%s\')', 'graphql-api-testing'),
                    $post->post_type,
                    implode(
                        __('\', \'', 'graphql-api-testing'),
                        $this->supportedCustomPostTypes
                    )
                ),
                [
                    Params::STATE => $customPostID,
                ]
            );
		}

		return $post;
	}

    public function retrieveAllItems(WP_REST_Request $request): WP_REST_Response|WP_Error
    {
        $items = [];
        $params = $request->get_params();
        $customPostID = (int)$params[Params::CUSTOM_POST_ID];
        /** @var WP_Post */
        $customPost = $this->getCustomPost($customPostID);
        $blocks = \parse_blocks($customPost->post_content);
        foreach ($blocks as $block) {
            $items[$block['blockName']] = $block['attrs'];
        }
        return rest_ensure_response($items);
    }

    protected function prepareItemForResponse(string $module): WP_REST_Response
    {
        $item = $this->prepareItem($module);
        $response = rest_ensure_response($item);
        $response->add_links($this->prepareLinks($module));
        return $response;
    }

    /**
     * @return array<string,mixed>
     */
    protected function prepareItem(string $module): array
    {
        $moduleRegistry = ModuleRegistryFacade::getInstance();
        $moduleResolver = $moduleRegistry->getModuleResolver($module);

        /**
         * Append the settings value, store in the DB, to the description
         * of the settings, which is defined by code.
         */
        $settings = $moduleResolver->getSettings($module);
        $userSettingsManager = UserSettingsManagerFacade::getInstance();
        $editableSettings = [];
        foreach ($settings as $setting) {
            // There are non-editable inputs, to show information. Skip those
            $input = $setting[Properties::INPUT] ?? null;
            if ($input === null) {
                continue;
            }
            $setting[ResponseKeys::VALUE] = $userSettingsManager->getSetting($module, $input);
            $editableSettings[] = $setting;
        }
        return [
            ResponseKeys::MODULE => $module,
            ResponseKeys::ID => $moduleResolver->getID($module),
            ResponseKeys::SETTINGS => $editableSettings,
        ];
    }

    public function retrieveItem(WP_REST_Request $request): WP_REST_Response|WP_Error
    {
        $params = $request->get_params();
        $customPostID = (int)$params[Params::CUSTOM_POST_ID];
        /** @var WP_Post */
        $customPost = $this->getCustomPost($customPostID);
        // $item = $this->prepareItemForResponse($module);
        $item = null;
        return rest_ensure_response($item);
    }

    /**
     * @return array<string,mixed>
     */
    protected function prepareLinks(string $module): array
    {
        $moduleRegistry = ModuleRegistryFacade::getInstance();
        $moduleResolver = $moduleRegistry->getModuleResolver($module);
        $customPostID = $moduleResolver->getID($module);
        return [
            'self' => [
                'href' => rest_url(
                    sprintf(
                        '%s/%s/%s',
                        $this->getNamespace(),
                        $this->restBase,
                        $customPostID,
                    )
                ),
            ],
            'collection' => [
                'href' => rest_url(
                    sprintf(
                        '%s/%s',
                        $this->getNamespace(),
                        $this->restBase,
                    )
                ),
            ],
            'module' => [
                'href' => rest_url(
                    sprintf(
                        '%s/%s/%s',
                        $this->getNamespace(),
                        'modules',
                        $customPostID,
                    )
                ),
            ],
        ];
    }

    public function updateItem(WP_REST_Request $request): WP_REST_Response|WP_Error
    {
        $response = new RESTResponse();

        try {
            $params = $request->get_params();
            $customPostID = $params[Params::CUSTOM_POST_ID];
            $optionValues = $params[Params::BLOCK_ATTRIBUTE_VALUES];
            // $module = $this->getModuleByID($customPostID);
            $module = $customPostID;

            $normalizedOptionValues = $optionValues;

            // Store in the DB
            $userSettingsManager = UserSettingsManagerFacade::getInstance();
            $userSettingsManager->setSettings($module, $normalizedOptionValues);

            /**
             * Flush rewrite rules in the next request.
             * Eg: after changing the path of the GraphiQL
             * client for the single endpoint,
             * accessing the previous path must produce a 404.
             *
             * Not all settings need flushing, so check first.
             */
            if ($this->shouldFlushRewriteRules($optionValues)) {
                $this->enqueueFlushRewriteRules();
            }

            // Success!
            $response->status = ResponseStatus::SUCCESS;
            $response->message = sprintf(
                __('Settings for module \'%s\' (with ID \'%s\') have been updated successfully', 'graphql-api-testing'),
                $module,
                $customPostID
            );
        } catch (Exception $e) {
            $response->status = ResponseStatus::ERROR;
            $response->message = $e->getMessage();
        }

        return rest_ensure_response($response);
    }

    /**
     * Some options need be flushed, others not.
     * To find out, check the settings inputs.
     *
     * Inputs that need flushing (implemented so far):
     *
     * - Path (eg: GraphiQL/Voyager clients)
     *
     * @param array<string,mixed> $optionValues
     */
    protected function shouldFlushRewriteRules(array $optionValues): bool
    {
        return array_key_exists(
            ModuleSettingOptions::PATH,
            $optionValues
        );
    }
}
