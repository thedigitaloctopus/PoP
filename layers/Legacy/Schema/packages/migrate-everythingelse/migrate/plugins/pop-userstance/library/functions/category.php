<?php

/**
 * Integration with Latest Everything Block
 */
\PoP\Root\App::addFilter('pop_element:allcontent:tax_query_items', 'popUserstanceSearchablecontentTaxquery');
function popUserstanceSearchablecontentTaxquery($tax_query_items)
{
    $cmsapplicationpostsapi = \PoP\Application\PostsFunctionAPIFactory::getInstance();
    if (in_array(POP_USERSTANCE_POSTTYPE_USERSTANCE, $cmsapplicationpostsapi->getAllcontentPostTypes())) {
        $tax_query_items[] = array(
            'taxonomy' => POP_USERSTANCE_TAXONOMY_STANCE,
            'terms' => array_filter(
                array(
                    POP_USERSTANCE_TERM_STANCE_PRO,
                    POP_USERSTANCE_TERM_STANCE_AGAINST,
                    POP_USERSTANCE_TERM_STANCE_NEUTRAL,
                )
            ),
        );
    }

    return $tax_query_items;
}
