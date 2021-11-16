<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3/9/2010 23:25
 */
if (! defined('NV_MAINFILE'))
    die('Stop!!!');



if (! nv_function_exists('nv_block_search2')) {
    
    if (! nv_function_exists('nv_bookhouse_numoney_to_strmoney')) {

        function nv_tours_numoney_to_strmoney($money)
        {
            global $lang_module;
            
            if ($money > 1000 and $money < 1000000) {
                $money = $money / 1000;
                return $money . ' ' . $lang_module['thousand'];
            } elseif ($money >= 1000000) {
                $money = $money / 1000000;
                return $money . ' ' . $lang_module['million'];
            }
            return $money;
        }
    }
    function nv_block_config_search2($module, $data_block, $lang_block)
    {	
        global $site_mods, $global_config, $nv_Cache;
       
if(NV_LANG_DATA == 'vi'){
	    $module_a = 'nha-dat';
}else{
	    $module_a = 'property';
}
		
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module_a]['module_data'] . '_categories ORDER BY parentid, weight ASC';
		
        $array_cat = $nv_Cache->db($sql, 'id', $module_a);
		
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/block_block_bookhouse_search_tab2.tpl')) {
            $block_theme = 'batdongsan05';
        } else {
            $block_theme = 'batdongsan05';
        }
		
        $xtpl = new XTemplate('block_block_bookhouse_search_tab2.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_block);
        $xtpl->assign('DATA', $data_block);
        $xtpl->assign('MODULE_NAME', $module);
        
        if (! empty($array_cat)) {
            foreach ($array_cat as $catid => $value) {
                if ($value['parentid'] == 0) {
                    $value['checked'] = in_array($catid, $data_block['catid']) ? 'checked="checled"' : '';
                    $xtpl->assign('CAT', $value);
                    $xtpl->parse('config.cat');
                }
            }
        }
        
        $xtpl->parse('config');
        return $xtpl->text('config');
    }

    function nv_block_config_search_submit2($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['catid'] = $nv_Request->get_typed_array('config_catid', 'post', 'int');
        $return['config']['price_begin'] = $nv_Request->get_title('config_price_begin', 'post', 1000000);
        $return['config']['price_end'] = $nv_Request->get_title('config_price_end', 'post', 20000000);
        $return['config']['price_step'] = $nv_Request->get_title('config_price_step', 'post', 1000000);
        return $return;
    }

    function nv_block_search2($block_config, $module)
    {
        global $db, $db_config, $site_mods, $module_info, $module_name, $module_config, $global_config, $array_config, $lang_module, $module_module_way, $nv_Request, $op, $module_file, $catid, $module_array_cat, $nv_Cache;
		
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];

if(NV_LANG_DATA == 'vi'){
	    $module = 'nha-dat';
}else{
	    $module = 'property';
}
		
	   
        if ($module != $module_name) {
            require_once NV_ROOTDIR . '/modules/location/location.class.php';
            require_once NV_ROOTDIR . '/modules/' . $site_mods[$module]['module_file'] . '/language/' . NV_LANG_INTERFACE . '.php';
        }
        
        $themetype = 'block_block_bookhouse_search_tab2.tpl';
        
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/' . $themetype)) {
            $block_theme = 'batdongsan05';
        } else {
            $block_theme = 'batdongsan05';
        }
		
        $array_search = array(
            'keywords' => $nv_Request->get_title('keywords', 'get,post', ''),
            'catid' => $nv_Request->get_int('catid', 'get,post', 0),
            'area' => $nv_Request->get_title('area', 'get,post', ''),
			'price_spread' => $nv_Request->get_title('price_spread', 'post,get', ''),
            'provinceid' => $nv_Request->get_int('provinceid', 'get,post', 0),
            'districtid' => $nv_Request->get_int('districtid', 'get,post', 0)
        );
       
        $xtpl = new XTemplate($themetype, NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_module);
        $xtpl->assign('MODULE_NAME', $module);
        $xtpl->assign('OP_NAME', 'search');//print_r($array_search);die;
        $xtpl->assign('SEARCH', $array_search);
        $xtpl->assign('DES_POINT', $array_config['dec_point']);
        $xtpl->assign('THOUSANDS_SEP', $array_config['thousands_sep']);
        
        $array_subcat = array();
        
        $i = $catid_active = 0;
        foreach ($block_config['catid'] as $index => $catid) {
            if ($index == $array_search['tab_index']) {
                $module_array_cat[$catid]['active'] = 'active';
                $catid_active = $catid;
            }
            $module_array_cat[$catid]['index'] = $index;
            $xtpl->assign('TAB', $module_array_cat[$catid]);
            $xtpl->parse('main.tab');
            $i ++;
            
            if(!empty($module_array_cat[$catid]['subid'])){
                $array_subid = explode(',', $module_array_cat[$catid]['subid']);
                $array_subid[] = $catid;
                foreach ($module_array_cat as $_catid => $value) {
                    if(in_array($_catid, $array_subid)){
                        $value['space'] = '';
                        if ($value['lev'] > 0) {
                            for ($i = 1; $i <= $value['lev']; $i ++) {
                                $value['space'] .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            }
                        }
                        $array_subcat[$catid][] = $value;
                    }
                }
            }
        }

        if(!empty($array_subcat)){
            foreach($array_subcat as $catid => $subcat){
                foreach($subcat as $cat){
                    $cat['selected'] = $cat['id'] == $array_search['catid'] ? 'selected="selected"' : '';
                    $xtpl->assign('CAT', $cat);
                    $xtpl->parse('main.cat.loop');
                }
                
                if($catid != $catid_active){
                    $xtpl->assign('CAT_HIDDEN', 'hidden');
                    $xtpl->assign('DISABLED', 'disabled');
                }else{
                    $xtpl->assign('CAT_HIDDEN', '');
                    $xtpl->assign('DISABLED', '');
                }
                
                $xtpl->assign('CATID', $catid);
                $xtpl->parse('main.cat');
            }
        }
        
        if (! empty($module_module_way)) {
            foreach ($module_module_way as $way) {
                $way['selected'] = $way['id'] == $array_search['way'] ? 'selected="selected"' : '';
                $xtpl->assign('WAY', $way);
                $xtpl->parse('main.way');
            }
        }
		
		// HƯỚNG BẤT ĐỘNG SẢN
		$list_huong = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_way')->fetchAll();
		
		foreach($list_huong as $huong)
		{
			$xtpl->assign('huong', $huong);
            $xtpl->parse('main.huong');
		}
        
        $location = new Location();
		$location->set('AllowProvince', $allow_province);
		$location->set('IsDistrict', 1);
		$location->set('IsWard', 1);
		$location->set('SelectProvinceid', $data['provinceid']);
		$location->set('SelectDistrictid', $data['districtid']);
		$location->set('SelectWardid', $data['wardid']);
		$location->set('BlankTitleProvince', 1);
		$location->set('BlankTitleDistrict', 1);
		$location->set('BlankTitleWard', 1);
        $location->set('Index', $block_config['bid']);
        $xtpl->assign('LOCATION', $location->buildInput());
        
        if ($array_config['sizetype'] == 0) {
            $xtpl->parse('main.area');
        } elseif ($array_config['sizetype'] == 1) {
            $xtpl->parse('main.size');
        }
        
        // Chon khoang gia
        $array_price_spread = array();
        $val = $block_config['price_begin'];
        while (true) {
            $price1 = $val;
            $price2 = $val + $block_config['price_step'];
            if ($val < $block_config['price_end']) {
                $array_price_spread[] = array(
                    'index' => $price1 . '-' . $price2,
                    'title' => nv_tours_numoney_to_strmoney($price1, $mod_file) . ' - ' . nv_tours_numoney_to_strmoney($price2, $mod_file)
                );
            } elseif ($val >= $block_config['price_end']) {
                $array_price_spread[] = array(
                    'index' => $price1 . '-0',
                    'title' => $lang_module['from'] . ' ' . nv_tours_numoney_to_strmoney($val, $mod_file)
                );
            }
            
            if ($val >= $block_config['price_end']) {
                break;
            }
            $val += $block_config['price_step'];
        }
        
        if (! empty($array_price_spread)) {
            foreach ($array_price_spread as $price_spread) {
                $price_spread['selected'] = $array_search['price_spread'] == $price_spread['index'] ? 'selected="selected"' : '';
                $xtpl->assign('PRICE_SPREAD', $price_spread);
                $xtpl->parse('main.price_spread');
            }
        }
        
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    global $site_mods, $array_cat, $array_config, $module_array_cat, $array_way, $module_module_way;
    
if(NV_LANG_DATA == 'vi'){
	    $module = 'nha-dat';
}else{
	    $module = 'property';
}
    
    if (isset($site_mods[$module])) {
        if ($module == $module_name) {
            $module_array_cat = $array_cat;
            $module_module_way = $array_way;
        } else {
            $module_array_cat = array();
            $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_categories ORDER BY parentid, weight ASC';
            $list = $nv_Cache->db($sql, 'id', $module);
            foreach ($list as $l) {
                $module_array_cat[$l['id']] = $l;
                $module_array_cat[$l['id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
            }
            
            $sql = "SELECT config_name, config_value FROM " . NV_PREFIXLANG . "_" . $site_mods[$module]['module_data'] . "_config";
            $list = $nv_Cache->db($sql, '', $module);
            foreach ($list as $ls) {
                $array_config[$ls['config_name']] = $ls['config_value'];
            }
            
            $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_way WHERE status=1';
            $module_module_way = $nv_Cache->db($sql, 'id', $module);
        }
        $content = nv_block_search2($block_config, $module);
    }
}
