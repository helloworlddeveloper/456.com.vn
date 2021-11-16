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

$page_title = $lang_module['search'];
$key_words = $module_info['keywords'];

$array_data = array();
$array_search = array(
    'q' => '',
    'catid' => 0,
    'price_from' => 0,
    'price_to' => 0,
    'area_from' => 0,
    'area_to' => 0,
    'size_v' => 0,
    'size_h' => 0,
    'way' => 0,
    'provinceid' => 0,
    'districtid' => 0,
    'wardid' => 0,
    'typeid' => 0
);
$where = $generate_page = '';
$is_search = 0;
$tab_index = $nv_Request->get_int('tab_index', 'get', 0);



$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . ($tab_index != 2 ? 'search' : $module_info['alias']['projects']);
$base_url_rewrite = $request_uri = urldecode($_SERVER['REQUEST_URI']);
$array_mod_title[] = array(
    'title' => $lang_module['search'],
    'link' => $base_url
);





if ($nv_Request->isset_request('search', 'get')) {
	
	
	$array_search = array(
        'q' => $nv_Request->get_title('keywords', 'get,post', ''),
        'catid' => $nv_Request->get_int('catid', 'get,post', 0),
        'area' => $nv_Request->get_title('area', 'get,post', ''),
        'chonphongngu' => $nv_Request->get_int('chonphongngu', 'get,post', 0),
        'price_spread' => $nv_Request->get_title('price_spread', 'get,post', ''),
        'provinceid' => $nv_Request->get_int('provinceid', 'get,post', 0),
        'districtid' => $nv_Request->get_int('districtid', 'get,post', 0),
        'wardid' => $nv_Request->get_int('wardid,post', 'get,post', 0),
        'huong_bds' => $nv_Request->get_int('huong_bds', 'get,post', 0),
        'phong_khach' => $nv_Request->get_int('phong_khach', 'get,post', 0),
        'phong_tam' => $nv_Request->get_int('phong_tam', 'get,post', 0)
    );

	
	if($tab_index == 2)
	{
       
	   if(!empty($array_search['q']))
		$where = ' AND title like "%'. $array_search['q'] .'%"';
	
	   
	   
	$db->sqlreset()
		->select('COUNT(*) ')
		->from(NV_PREFIXLANG . '_' . $module_data . '_projects')
		->where('status=1' . $where);

	$num_items = $db->query($db->sql())
		->fetchColumn();

	$db->select('id, typeid, title, alias, vondautu, soblock, chudautu, sotang, dientich, socanho, sophong, giaban, giathue, description, homeimg, provinceid, districtid, wardid, maps')
		->order('id DESC')
		->limit($per_page)
		->offset(($page - 1) * $per_page);
	
	$result = $db->query($db->sql());

	$location = new Location();

	$module_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;

	while ($item = $result->fetch()) {
		if (!empty($item['homeimg']) && file_exists(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_upload . '/' . $item['homeimg'])) {
			$item['homeimg'] = NV_BASE_SITEURL . NV_ASSETS_DIR . '/' . $module_upload . '/' . $item['homeimg'];
		} elseif (!empty($item['homeimg']) && file_exists(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $item['homeimg'])) {
			$item['homeimg'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $item['homeimg'];
		} else {
			$item['homeimg'] = '';
		}

		$item['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['project-detail'] . '/' . $item['alias'] . '-' . $item['id'];
		
		$item['location'] = $location->locationString($item['provinceid'], $item['districtid'], $item['wardid'], ' » ', $module_url);
		
		$item['maps'] = ! empty($item['maps']) ? unserialize($item['maps']) : array();
		
		$array_data[$item['id']] = $item;
		
	}

	$generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);

	$contents = nv_theme_bookhouse_projects($array_data, $generate_page);

	   
	}
	else
	{

    $is_search = 1;
    $page = $nv_Request->get_int('page', 'get', 1);
    $num_items = 0;
   
    
    if (! empty($array_search['q']) and $tab_index != 2 ) {
        $where .= ' AND title like "%' . $array_search['q'] . '%"';
        $base_url .= '&q=' . $array_search['q'];
    }
    
    if (! empty($array_search['catid'])) {
		//print_r($array_cat);die;
		if($array_cat[$array_search['catid']]['numsub'] > 0)
		{	//print($array_cat[$array_search['catid']]['subid']);die;
			$where .= ' AND catid IN (' . $array_cat[$array_search['catid']]['subid'] . ')';
		}
		else
		{
			$where .= ' AND catid = ' . $array_search['catid'];
		}
        $base_url .= '&catid=' . $array_search['catid'];
    }else{
        $base_url_rewrite = str_replace('&catid=' . $array_search['catid'], '', $base_url_rewrite);
    }
	//DIE($where );
	// diện tích
	if (! empty($array_search['area'])) {
		$mang_area = explode('-',$array_search['area']);
		$where .= ' AND area >= '.$mang_area[0].' AND area <= '.$mang_area[1];
	}else{
        $base_url_rewrite = str_replace('&area=' . $array_search['area'], '', $base_url_rewrite);
}
	
	// phòng ngủ 
	if ($array_search['chonphongngu'] > 0) {
		$where .= ' AND phong_ngu = '.$array_search['chonphongngu'];
	}else{
        $base_url_rewrite = str_replace('&chonphongngu=' . $array_search['chonphongngu'], '', $base_url_rewrite);
}
	
	// phòng khách 
	if ($array_search['phong_khach'] > 0) {
		$where .= ' AND phong_khach = '.$array_search['phong_khach'];
	}else{
        $base_url_rewrite = str_replace('&phong_khach=' . $array_search['phong_khach'], '', $base_url_rewrite);
}
	
	// phòng tắm
	if ($array_search['phong_tam'] > 0) {
		$where .= ' AND phong_tam = '.$array_search['phong_tam'];
	}else{
        $base_url_rewrite = str_replace('&phong_tam=' . $array_search['phong_tam'], '', $base_url_rewrite);
}
	
	
	// giá
	
    if (! empty($array_search['price_from']) or ! empty($array_search['price_to'])) {
        $where .= ' AND showprice = 1';
    }
    
    if (! empty($array_search['price_from'])) {
        if($array_config['pricetype'] == 1){
            $array_search['price_from'] = $array_search['price_from'] . '000000';
        }
        $where .= ' AND price >= ' . doubleval($array_search['price_from']);
        $base_url .= '&price_from=' . $array_search['price_from'];
    }else{
        $base_url_rewrite = str_replace('&price_from=' . $array_search['price_from'], '', $base_url_rewrite);
    }
    
    if (! empty($array_search['price_to'])) {
        if($array_config['pricetype'] == 1){
            $array_search['price_to'] = $array_search['price_to'] . '000000';
        }
        $where .= ' AND price <= ' . doubleval($array_search['price_to']);
        $base_url .= '&price_to=' . $array_search['price_to'];
    }else{
        $base_url_rewrite = str_replace('&price_to=' . $array_search['price_to'], '', $base_url_rewrite);
    }

    if(!empty($array_search['price_spread'])){
        $base_url .= 'price_spread=' . $array_search['price_spread'];
        $price_spread = explode('-', $array_search['price_spread']);
        if(sizeof($price_spread) == 2){
	        $where .= ' AND (price >= ' . $price_spread[0] . ' AND price <= ' . $price_spread[1] . ')';
        }
		
    }else{
        $base_url_rewrite = str_replace('&price_spread=' . $array_search['price_spread'], '', $base_url_rewrite);
    }

    //print($array_search['huong_bds']);die;
    if (! empty($array_search['huong_bds'])) {
        $where .= ' AND way_id=' . $array_search['huong_bds'];
        $base_url .= 'way=' . $array_search['huong_bds'];
    }else{
        $base_url_rewrite = str_replace('&huong_bds=' . $array_search['huong_bds'], '', $base_url_rewrite);
    }
    
    if (! empty($array_search['provinceid'])) {
        $where .= ' AND provinceid = ' . $array_search['provinceid'];
        $base_url .= '&provinceid=' . $array_search['provinceid'];
    }else{
        $base_url_rewrite = str_replace('&provinceid=' . $array_search['provinceid'], '', $base_url_rewrite);
    }
    
    if (! empty($array_search['districtid'])) {
        $where .= ' AND districtid = ' . $array_search['districtid'];
        $base_url .= '&districtid=' . $array_search['districtid'];
    }else{
        $base_url_rewrite = str_replace('&districtid=' . $array_search['districtid'], '', $base_url_rewrite);
    }
    
    if (! empty($array_search['wardid'])) {
        $where .= ' AND wardid = ' . $array_search['wardid'];
        $base_url .= '&wardid=' . $array_search['wardid'];
    }else{
        $base_url_rewrite = str_replace('&wardid=' . $array_search['wardid'], '', $base_url_rewrite);
    }
    
    if (! empty($array_search['typeid'])) {
        $where .= ' AND typeid = ' . $array_search['typeid'];
        $base_url .= '&typeid=' . $array_search['typeid'];
    }else{
        $base_url_rewrite = str_replace('&typeid=' . $array_search['typeid'], '', $base_url_rewrite);
    }

    $base_url_rewrite = nv_url_rewrite($base_url_rewrite, true);



    if ($request_uri != $base_url_rewrite and NV_MAIN_DOMAIN . $request_uri != $base_url_rewrite) {
        header('Location: ' . $base_url_rewrite);
        die();
    }

    $location = new Location();
    
    if (! empty($where)) {
        $db->sqlreset()
            ->select('COUNT(*) ')
            ->from(NV_PREFIXLANG . '_' . $module_data)
            ->where('status=1 AND status_admin=1 AND is_queue=0 AND inhome=1 AND (exptime > ' . NV_CURRENTTIME . ' OR exptime = 0) ' . $where);
       // die($db->sql());
        $num_items = $db->query($db->sql())
            ->fetchColumn();
       
        $db->select('id, catid, title, alias, code, area, maps, size_v, size_h, price, addtime, admin_id, provinceid, districtid, wardid, way_id, address, structure, price_time, bodytext, homeimgfile, homeimgthumb, showprice, group_config, phong_tam, phong_ngu')
            ->order('ordertime DESC')
            ->limit($per_page)
            ->offset(($page - 1) * $per_page);
      // die($db->sql());
        $result = $db->query($db->sql());
        while ($item = $result->fetch()) {
            $array_data[] = nv_data_show($item);
        }
        
        $generate_page = '';
        if ($num_items > $per_page) {
            $url_link = $_SERVER['REQUEST_URI'];
            if (strpos($url_link, '&page=') > 0) {
                $url_link = substr($url_link, 0, strpos($url_link, '&page='));
            } elseif (strpos($url_link, '?page=') > 0) {
                $url_link = substr($url_link, 0, strpos($url_link, '?page='));
            }
            $_array_url = array( 'link' => $url_link, 'amp' => '&page=' );
            $generate_page = nv_generate_page($_array_url, $num_items, $per_page, $page);
        }
        
    }
    $lang_module['search_result'] = sprintf($lang_module['search_result'], $num_items);
	
	$contents = nv_theme_bookhouse_search($array_data, $is_search, $generate_page);
	
	}
}



include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
