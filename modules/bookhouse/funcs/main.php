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

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
$contents = '';

if (! defined('NV_IS_MODADMIN') and $page < 5) {
    $cache_file = NV_LANG_DATA . '_' . $module_info['template'] . '_' . $op . '_' . $array_config['display_data'] . '_' . $array_config['display_type'] . '_' . $page . '_' . NV_CACHE_PREFIX . '.cache';
    if (($cache = $nv_Cache->getItem($module_name, $cache_file)) != false) {
        $contents = $cache;
    }
}
$per_page = 10;
if (true) {
    $array_data = array();
    $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
    
    if ($array_config['display_data'] == 0) {
        $db->sqlreset()
            ->select('COUNT(*) ')
            ->from(NV_PREFIXLANG . '_' . $module_data)
            ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime > ' . NV_CURRENTTIME . ' OR exptime = 0)');
        
        $num_items = $db->query($db->sql())
            ->fetchColumn();
        
        $db->select('id, catid, title, alias, code, area, maps, size_v, size_h, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, money_unit, bodytext, homeimgfile, homeimgthumb, showprice, group_config, phong_tam, phong_ngu ')
            ->order('ordertime DESC')
            ->limit($per_page)
            ->offset(($page - 1) * $per_page);
        
        $result = $db->query($db->sql());
        while ($item = $result->fetch()) {
            $array_data[] = nv_data_show($item);
        }
        
        if ($page > 1) {
            $page_title = $page_title . ' - ' . $lang_global['page'] . ' ' . $page;
        }
        
		
        $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
		
        
        $contents = nv_theme_viewhome($array_data, $generate_page, $array_config['display_type']);
    } elseif ($array_config['display_data'] == 1) {
        foreach ($array_cat as $catid_i => $array_info_i) {
            if ($array_info_i['parentid'] == 0) {
                $array_catid = nv_GetCatidInParent($catid_i);
                
                $db->sqlreset()
                    ->select('COUNT(*) ')
                    ->from(NV_PREFIXLANG . '_' . $module_data)
                    ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime > ' . NV_CURRENTTIME . ' OR exptime = 0) AND catid IN (' . $db->quote(implode(',', $array_catid)) . ')');
                
                $num_items = $db->query($db->sql())
                    ->fetchColumn();
                
                $db->select('id, catid, title, alias, code, area, maps, size_v, size_h, price, money_unit, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, bodytext, homeimgfile, homeimgthumb, showprice, group_config, phong_tam, phong_ngu ')
                    ->limit($per_page)
                    ->offset(($page - 1) * $per_page);
                
                $result = $db->query($db->sql());
                
                $array_items = array();
                while ($item = $result->fetch()) {
                    $array_items[] = nv_data_show($item);
                }
                $array_data[$catid_i] = array(
                    'catid_i' => $catid_i,
                    'title' => $array_info_i['title'],
                    'link' => $array_info_i['link'],
                    'num_items' => $num_items,
                    'data' => $array_items
                );
            }
        }
		
		
      
        $contents = nv_theme_viewhome($array_data, $array_config['display_type']);
    } else {
        include NV_ROOTDIR . '/includes/header.php';
        echo nv_site_theme('');
        include NV_ROOTDIR . '/includes/footer.php';
        exit();
    }
    
    if (! defined('NV_IS_MODADMIN') and $contents != '' and $cache_file != '') {
        $nv_Cache->setItem($module_name, $cache_file, $contents);
    }
}

if (! defined('NV_IS_MODADMIN') and $contents != '' and $cache_file != '') {
    $nv_Cache->setItem($module_name, $cache_file, $contents);
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
