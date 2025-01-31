<?php

// \PoP\Root\App::addFilter('PoP_Module_Processor_MenuMultiplesBase:active-link-menu-item-ids', 'addActiveMenuitemParentitem', 10, 3);
// function addActiveMenuitemParentitem($active_link_menu_item_ids, \PoP\ComponentModel\Component\Component $component, array &$props)
// {
//     $add_parentpageid = \PoP\Root\App::applyFilters(
//         'PoP_Module_Processor_MenuMultiplesBase:js-setting:add-active-parent-item',
//         false,
//         $component,
//         $props
//     );
//     if ($add_parentpageid) {
//         if (\PoP\Root\App::getState(['routing', 'is-page'])) {
//             $post_id = \PoP\Root\App::getState(['routing', 'queried-object-id']);
//             $parentpageid = $post_id;
//         }
//         // retrieve the page for the category for the post
//         elseif (\PoP\Root\App::getState(['routing', 'is-custompost'])) {
//             $post_id = \PoP\Root\App::getState(['routing', 'queried-object-id']);
//             $parentpageid = gdPostParentpageid($post_id);
//         }
//         // retrieve the page for the authors
//         elseif (\PoP\Root\App::getState(['routing', 'is-user'])) {
//             $author = \PoP\Root\App::getState(['routing', 'queried-object-id']);
//             $parentpageid = gdAuthorParentpageid($author);
//         }
//         if ($parentpageid) {
//             $active_link_menu_item_ids[] = $parentpageid;
//         }
//     }

//     return $active_link_menu_item_ids;
// }

// // Returns the id of the page showing all items of same $post_type, $cat as the one with $post_id
// // (Used for painting navigation in single.php)
// function gdPostParentpageid($post_id)
// {
//     return \PoP\Root\App::applyFilters('gdPostParentpageid', null, $post_id);
// }

// Returns the id of the page showing all items of same role (Organizations / Individuals)
function gdAuthorParentpageid($author_id)
{
    return \PoP\Root\App::applyFilters('gdAuthorParentpageid', null, $author_id);
}
