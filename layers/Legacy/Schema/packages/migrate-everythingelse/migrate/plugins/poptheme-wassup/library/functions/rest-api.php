<?php

// Disable the JSON REST API. Valid until WP 4.6.1. For 4.7 onwards, must use plug-in "Disable REST API" (https://wordpress.org/plugins/disable-json-api/)
\PoP\Root\App::addFilter('rest_enabled', __return_false(...));
