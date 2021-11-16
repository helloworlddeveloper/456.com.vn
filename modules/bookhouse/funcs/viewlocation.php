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

require_once NV_ROOTDIR . '/modules/location/location.class.php';
$location = new Location();
$where = '';

switch ($array_op[0]) {
    case 'p':
        $location_info = $location->getProvinceInfo($id);
        $array_local_id = array_keys($location->getArrayDistrict('', $id));
        $where .= ' AND (provinceid=' . $id . ' OR districtid IN (' . implode(',', $array_local_id) . '))';
        break;
    case 'd':
        $location_info = $location->getDistricInfo($id);
        $array_local_id = array_keys($location->getArrayWard('', $id));
        $where .= ' AND districtid=' . $id;
        break;
    default:
        $location_info = $location->getWardInfo($id);
        break;
}

if (! defined('NV_IS_MODADMIN') and $page < 5) {
    $cache_file = NV_LANG_DATA . '_' . $module_info['template'] . '_' . $op . '_' . $array_op[0] . '_' . $array_op[1] . '_' . $id . '_' . $page . '_' . NV_CACHE_PREFIX . '.cache';
    if (($cache = $nv_Cache->getItem($module_name, $cache_file)) != false) {
        $contents = $cache;
    }
}

if (empty($contents)) {
    $array_data = array();
    
    $page_title = $location_info['name'];
    
    $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $array_op[0] . '/' . $array_op[1] . '-' . $id;
    
    $db->sqlreset()
        ->select('COUNT(*) ')
        ->from(NV_PREFIXLANG . '_' . $module_data)
        ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime > ' . NV_CURRENTTIME . ' OR exptime = 0) ' . $where);
    
    $num_items = $db->query($db->sql())
        ->fetchColumn();
    
    $db->select('id, catid, title, alias, code, area, size_v, size_h, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, bodytext, homeimgfile, homeimgthumb, showprice, group_config')
        ->order('prior DESC, ordertime DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    
    $result = $db->query($db->sql());
    
    while ($item = $result->fetch()) {
        $array_data[] = nv_data_show($item);
    }
    
    $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
    
    $contents = nv_theme_viewlocation($array_data, $location_info, $generate_page);
    
    if (! defined('NV_IS_MODADMIN') and $contents != '' and $cache_file != '') {
        $nv_Cache->setItem($module_name, $cache_file, $contents);
    }
}

$array_mod_title[] = array(
    'title' => $page_title,
    'link' => $base_url
);

if ($page > 1) {
    $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
    $description .= ' ' . $page;
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
