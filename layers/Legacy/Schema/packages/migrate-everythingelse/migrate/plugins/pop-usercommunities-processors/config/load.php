<?php

// High priority: allow the Theme and other plug-ins to set the values in advance.
\PoP\Root\App::addAction(
    'popcms:init', 
    'popUsercommunitiesprocessorsInitConstants', 
    10000
);
function popUsercommunitiesprocessorsInitConstants()
{
    include_once 'constants.php';
}
