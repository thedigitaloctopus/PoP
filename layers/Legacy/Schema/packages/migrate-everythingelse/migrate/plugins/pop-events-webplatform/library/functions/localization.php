<?php

\PoP\Root\App::addFilter('gd_jquery_constants', gdEmJqueryConstantsUrlparams(...));
function gdEmJqueryConstantsUrlparams($jqueryConstants)
{
    $jqueryConstants['URLPARAM_YEAR'] = GD_URLPARAM_YEAR;
    $jqueryConstants['URLPARAM_MONTH'] = GD_URLPARAM_MONTH;
    
    return $jqueryConstants;
}
