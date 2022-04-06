<?php

declare(strict_types=1);

namespace GraphQLAPI\WPFakerSchema\UsersWP\TypeAPIs;

use GraphQLAPI\WPFakerSchema\App;
use PoPCMSSchema\UsersWP\TypeAPIs\UserTypeAPI as UpstreamUserTypeAPI;
use WP_User;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class UserTypeAPI extends UpstreamUserTypeAPI
{
    protected function getUsersByCMS(array $query): array
    {
        $users = App::getWPFaker()->users(3);
        if (($query['fields'] ?? null) === 'ID') {
            $users = array_map(
                fn (WP_User $user) => $user->ID,
                $users
            );
        }
        return $users;
    }
}
