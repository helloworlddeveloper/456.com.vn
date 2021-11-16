<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 13 Aug 2014 00:24:32 GMT
 */
if (! defined('NV_IS_MOD_BOOKHOUSE'))
    die('Stop!!!');

$page_title = $array_cat[$catid]['title'];
$description = $array_cat[$catid]['description'];


if (! defined('NV_IS_MODADMIN') and $page < 5) {
    $cache_file = NV_LANG_DATA . '_' . $module_info['template'] . '_' . $op . '_' . $catid . '_' . $page . '_' . NV_CACHE_PREFIX . '.cache';
    if (($cache = $nv_Cache->getItem($module_name, $cache_file)) != false) {
        $contents = $cache;
    }
}

$array_catid = nv_GetCatidInParent($catid);
//print_r(implode(',', $array_catid));die;

if (empty($contents)) {
    $array_data = array();
    $base_url = $array_cat[$catid]['link'];
    
    $db->sqlreset()
        ->select('COUNT(*) ')
        ->from(NV_PREFIXLANG . '_' . $module_data)
        ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime > ' . NV_CURRENTTIME . ' OR exptime = 0) AND catid IN (' . implode(',', $array_catid) . ')');
   // print_r($db->sql());die;
    $num_items = $db->query($db->sql())
        ->fetchColumn();
    
    $db->select('id, catid, title, alias, code, area, maps, size_v, size_h, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, money_unit, bodytext, homeimgfile, homeimgthumb, showprice, group_config, phong_tam, phong_ngu')
        ->order('prior DESC, ordertime DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    
    $result = $db->query($db->sql());
    
    while ($item = $result->fetch()) {
	
        $array_data[] = nv_data_show($item);
    }

    $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
    
    $contents = nv_theme_viewcat($array_data, $generate_page);
    
    if (! defined('NV_IS_MODADMIN') and $contents != '' and $cache_file != '') {
        $nv_Cache->setItem($module_name, $cache_file, $contents);
    }
}

if ($page > 1) {
    $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
    $description .= ' ' . $page;
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
