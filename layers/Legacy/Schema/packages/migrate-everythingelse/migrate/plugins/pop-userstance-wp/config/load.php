<?php

// High priority: allow the Theme and other plug-ins to set the values in advance.
\PoP\Root\App::addAction(
    'popcms:init', 
    'popUserstanceCmswpInitConstants', 
    10000
);
function popUserstanceCmswpInitConstants()
{
    include_once 'constants.php';
}
