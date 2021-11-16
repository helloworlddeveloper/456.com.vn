<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Wed, 16 Dec 2015 01:44:45 GMT
 */
if (! defined('NV_IS_MOD_BOOKHOUSE'))
    die('Stop!!!');

if (isset($array_op[1])) {
    $alias = trim($array_op[1]);
    $page = (isset($array_op[2]) and substr($array_op[2], 0, 5) == 'page-') ? intval(substr($array_op[2], 5)) : 1;
    
    $stmt = $db->prepare('SELECT bid, title, alias, image, description, keywords FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE alias= :alias');
    $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
    $stmt->execute();
    list ($bid, $page_title, $alias, $image_group, $description, $key_words) = $stmt->fetch(3);
    if ($bid > 0) {
        $base_url_rewrite = $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['groups'] . '/' . $alias;
        $array_data = array();
        
        if ($page > 1) {
            $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
            $base_url_rewrite .= '/page-' . $page;
        }
        $base_url_rewrite = nv_url_rewrite($base_url_rewrite, true);
        if ($_SERVER['REQUEST_URI'] != $base_url_rewrite and NV_MAIN_DOMAIN . $_SERVER['REQUEST_URI'] != $base_url_rewrite) {
            Header('Location: ' . $base_url_rewrite);
            die();
        }
        
        $array_mod_title[] = array(
            'catid' => 0,
            'title' => $page_title,
            'link' => $base_url
        );
		
		
        
        // Lấy danh sách ID bđs thuộc nhóm
        $array_id = array();
        $result = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE bid=' . $bid);
        while (list ($id) = $result->fetch(3)) {
            $array_id[] = $id;
        }
        
        if (! empty($array_id)) {
            $db->sqlreset()
                ->select('COUNT(*) ')
                ->from(NV_PREFIXLANG . '_' . $module_data)
                ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime = 0 OR exptime > ' . NV_CURRENTTIME . ') AND id IN(' . implode(',', $array_id) . ')');
            
            $num_items = $db->query($db->sql())
                ->fetchColumn();
            
            $db->select('id, catid, title, alias, code, area, size_v, size_h, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, money_unit, bodytext, homeimgfile, homeimgthumb, showprice, group_config, phong_tam, phong_ngu')
                ->order('prior DESC, ordertime DESC')
                ->limit($per_page)
                ->offset(($page - 1) * $per_page);
            
            $result = $db->query($db->sql());
            while ($item = $result->fetch()) {
                $array_data[] = nv_data_show($item);
            }
        }
		
        $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
        $contents = call_user_func('nv_theme_viewhome', $array_data, $generate_page);
    }
} else {
    Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true));
    die();
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';