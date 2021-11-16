<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 03 Jan 2017 03:28:49 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

if ($nv_Request->isset_request('get_alias_title', 'post')) {
    $alias = $nv_Request->get_title('get_alias_title', 'post', '');
    $alias = change_alias($alias);
    die($alias);
}

$username_alias = change_alias($admin_info['username']);
$array_structure_image = array();
$array_structure_image[''] = $module_upload;
$array_structure_image['Y'] = $module_upload . '/' . date('Y');
$array_structure_image['Ym'] = $module_upload . '/' . date('Y_m');
$array_structure_image['Y_m'] = $module_upload . '/' . date('Y/m');
$array_structure_image['Ym_d'] = $module_upload . '/' . date('Y_m/d');
$array_structure_image['Y_m_d'] = $module_upload . '/' . date('Y/m/d');
$array_structure_image['username'] = $module_upload . '/' . $username_alias;

$array_structure_image['username_Y'] = $module_upload . '/' . $username_alias . '/' . date('Y');
$array_structure_image['username_Ym'] = $module_upload . '/' . $username_alias . '/' . date('Y_m');
$array_structure_image['username_Y_m'] = $module_upload . '/' . $username_alias . '/' . date('Y/m');
$array_structure_image['username_Ym_d'] = $module_upload . '/' . $username_alias . '/' . date('Y_m/d');
$array_structure_image['username_Y_m_d'] = $module_upload . '/' . $username_alias . '/' . date('Y/m/d');

$structure_upload = isset($array_config['structure_upload']) ? $array_config['structure_upload'] : 'Ym';
$currentpath = isset($array_structure_image[$structure_upload]) ? $array_structure_image[$structure_upload] : '';

if (file_exists(NV_UPLOADS_REAL_DIR . '/' . $currentpath)) {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $currentpath;
} else {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $module_upload;
    $e = explode('/', $currentpath);
    if (!empty($e)) {
        $cp = '';
        foreach ($e as $p) {
            if (!empty($p) and !is_dir(NV_UPLOADS_REAL_DIR . '/' . $cp . $p)) {
                $mk = nv_mkdir(NV_UPLOADS_REAL_DIR . '/' . $cp, $p);
                if ($mk[0] > 0) {
                    $upload_real_dir_page = $mk[2];
                    $db->query("INSERT INTO " . NV_UPLOAD_GLOBALTABLE . "_dir (dirname, time) VALUES ('" . NV_UPLOADS_DIR . "/" . $cp . $p . "', 0)");
                }
            } elseif (!empty($p)) {
                $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $cp . $p;
            }
            $cp .= $p . '/';
        }
    }
    $upload_real_dir_page = str_replace('\\', '/', $upload_real_dir_page);
}


$currentpath = str_replace(NV_ROOTDIR . '/', '', $upload_real_dir_page);
$uploads_dir_user = NV_UPLOADS_DIR . '/' . $module_upload;
if (!defined('NV_IS_SPADMIN') and strpos($structure_upload, 'username') !== false) {
    $array_currentpath = explode('/', $currentpath);
    if ($array_currentpath[2] == $username_alias) {
        $uploads_dir_user = NV_UPLOADS_DIR . '/' . $module_upload . '/' . $username_alias;
    }
}
$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['alias'] = $nv_Request->get_title('alias', 'post', '');
    $row['alias'] = (empty($row['alias'])) ? change_alias($row['title']) : change_alias($row['alias']);
	$row['dientichxd'] = $nv_Request->get_title('dientichxd', 'post', '');
	$row['thoigianxd'] = $nv_Request->get_title('thoigianxd', 'post', '');
	$row['thoigiangn'] = $nv_Request->get_title('thoigiangn', 'post', '');
	$row['vondautu'] = $nv_Request->get_title('vondautu', 'post', '');
	$row['chudautu'] = $nv_Request->get_title('chudautu', 'post', '');
	$row['dientich'] = $nv_Request->get_title('dientich', 'post', '');
	$row['sophong'] = $nv_Request->get_title('sophong', 'post', '');
	$row['soblock'] = $nv_Request->get_title('soblock', 'post', '');
	$row['sotang'] = $nv_Request->get_title('sotang', 'post', '');
	$row['socanho'] = $nv_Request->get_title('socanho', 'post', '');
	$row['khonggianxanh'] = $nv_Request->get_title('khonggianxanh', 'post', '');
	$row['matdo'] = $nv_Request->get_title('matdo', 'post', '');
	$row['phiquanly'] = $nv_Request->get_title('phiquanly', 'post', '');
	$row['giuoto'] = $nv_Request->get_title('giuoto', 'post', '');
	$row['giuxemay'] = $nv_Request->get_title('giuxemay', 'post', '');
	$row['giaban'] = $nv_Request->get_title('giaban', 'post', '');
	$row['giathue'] = $nv_Request->get_title('giathue', 'post', '');
	
	$tienich = array_unique( $nv_Request->get_typed_array( 'tienich', 'post,get', 'int', array() ) );
	$row['tienich'] = implode( ',', $tienich );
	
	$noithat = array_unique( $nv_Request->get_typed_array( 'noithat', 'post,get', 'int', array() ) );
	$row['noithat'] = implode( ',', $noithat );
	
	$row['inhome'] = (int) $nv_Request->get_bool('inhome', 'post');
	
    $row['description'] = $nv_Request->get_string('description', 'post', '');
    $row['descriptionhtml'] = $nv_Request->get_editor('descriptionhtml', '', NV_ALLOWED_HTML_TAGS);
    $row['provinceid'] = $nv_Request->get_int('provinceid', 'post', 0);
    $row['districtid'] = $nv_Request->get_int('districtid', 'post', 0);
    $row['wardid'] = $nv_Request->get_int('wardid', 'post', 0);
	$row['address'] = $nv_Request->get_string('address', 'post', '');
    
	$row['maps'] = $nv_Request->get_array('maps', 'post', array());
    $row['maps'] = serialize($row['maps']);
	
        
    $row['homeimg'] = $nv_Request->get_int('homeimg', 'post', 0);
    $row['image'] = $nv_Request->get_string('image', 'post', '');

    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    } elseif (empty($row['description'])) {
        $error[] = $lang_module['error_required_description'];
    } elseif (empty($row['provinceid'])) {
        $error[] = $lang_module['error_required_location'];
    }

    if (empty($error)) {

        $array_images = array();
        $row['otherimage'] = $nv_Request->get_array('otherimage', 'post');
        foreach ($row['otherimage'] as $otherimage) {
            if (!empty($otherimage['homeimgfile']) && file_exists(NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $otherimage['homeimgfile'])) {
                if (@nv_copyfile(NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $otherimage['homeimgfile'], NV_ROOTDIR . '/' . $currentpath . '/' . $otherimage['basename'])) {
                    $otherimage['basename'] = str_replace(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/', '', $currentpath . '/' . $otherimage['basename']);
                    nv_getnews_viewImage($otherimage['basename']);
                    nv_delete_other_images_tmp(NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $otherimage['homeimgfile'], NV_ROOTDIR . $otherimage['thumb']);
                }
            }
            $array_images[] = str_replace(NV_UPLOADS_DIR . '/' . $module_data . '/', '', $otherimage['basename']);
        }
        $row['homeimg'] = $array_images[$row['homeimg']];
        $row_image = implode('|', $array_images);

        try {
            if (empty($row['id'])) {
                $row['homeimg'] = str_replace(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/', '', $currentpath . '/' . $row['homeimg']);
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_projects (title, alias, dientichxd, thoigianxd, thoigiangn, vondautu, chudautu, dientich, sophong, soblock, sotang, socanho, khonggianxanh, matdo, phiquanly, giuoto, giuxemay, giaban, giathue, tienich, noithat, inhome, description, descriptionhtml, provinceid, districtid, wardid, address, maps, homeimg, image) VALUES (:title, :alias, :dientichxd,:thoigianxd,:thoigiangn,:vondautu,:chudautu,:dientich,:sophong,:soblock,:sotang,:socanho,:khonggianxanh, :matdo, :phiquanly, :giuoto, :giuxemay, :giaban, :giathue, :tienich, :noithat, :inhome,:description, :descriptionhtml, :provinceid, :districtid, :wardid, :address, :maps, :homeimg, :image)'); 
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_projects SET title = :title, alias = :alias, dientichxd = :dientichxd, thoigianxd = :thoigianxd, thoigiangn = :thoigiangn, vondautu = :vondautu, chudautu = :chudautu, dientich = :dientich, sophong = :sophong, soblock =:soblock, sotang =:sotang, socanho =:socanho, khonggianxanh =:khonggianxanh, matdo =:matdo, phiquanly =:phiquanly, giuoto =:giuoto, giuxemay =:giuxemay, giaban =:giaban, giathue =:giathue, tienich =:tienich, noithat =:noithat, inhome =:inhome, description = :description, descriptionhtml =:descriptionhtml, provinceid = :provinceid, districtid = :districtid, wardid = :wardid, address = :address,  maps =:maps, homeimg = :homeimg, image = :image WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
            $stmt->bindParam(':alias', $row['alias'], PDO::PARAM_STR);
            $stmt->bindParam(':dientichxd', $row['dientichxd'], PDO::PARAM_STR);
            $stmt->bindParam(':thoigianxd', $row['thoigianxd'], PDO::PARAM_STR);
            $stmt->bindParam(':thoigiangn', $row['thoigiangn'], PDO::PARAM_STR);
            $stmt->bindParam(':vondautu', $row['vondautu'], PDO::PARAM_STR);
            $stmt->bindParam(':chudautu', $row['chudautu'], PDO::PARAM_STR);
            $stmt->bindParam(':dientich', $row['dientich'], PDO::PARAM_STR);
            $stmt->bindParam(':sophong', $row['sophong'], PDO::PARAM_STR);
            $stmt->bindParam(':soblock', $row['soblock'], PDO::PARAM_STR);
            $stmt->bindParam(':sotang', $row['sotang'], PDO::PARAM_STR);
            $stmt->bindParam(':socanho', $row['socanho'], PDO::PARAM_STR);
            $stmt->bindParam(':khonggianxanh', $row['khonggianxanh'], PDO::PARAM_STR);
            $stmt->bindParam(':matdo', $row['matdo'], PDO::PARAM_STR);
            $stmt->bindParam(':phiquanly', $row['phiquanly'], PDO::PARAM_STR);
            $stmt->bindParam(':giuoto', $row['giuoto'], PDO::PARAM_STR);
            $stmt->bindParam(':giuxemay', $row['giuxemay'], PDO::PARAM_STR);
            $stmt->bindParam(':giaban', $row['giaban'], PDO::PARAM_STR);
            $stmt->bindParam(':giathue', $row['giathue'], PDO::PARAM_STR);
            $stmt->bindParam(':tienich', $row['tienich'], PDO::PARAM_STR);
            $stmt->bindParam(':noithat', $row['noithat'], PDO::PARAM_STR);
			$stmt->bindParam(':inhome', $row['inhome'], PDO::PARAM_INT);
            $stmt->bindParam(':description', $row['description'], PDO::PARAM_STR, strlen($row['description']));
            $stmt->bindParam(':descriptionhtml', $row['descriptionhtml'], PDO::PARAM_STR, strlen($row['descriptionhtml']));
            $stmt->bindParam(':provinceid', $row['provinceid'], PDO::PARAM_STR);
            $stmt->bindParam(':districtid', $row['districtid'], PDO::PARAM_STR);
            $stmt->bindParam(':wardid', $row['wardid'], PDO::PARAM_STR);
			$stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
            $stmt->bindParam(':maps', $row['maps'], PDO::PARAM_STR);
            $stmt->bindParam(':homeimg', $row['homeimg'], PDO::PARAM_STR);
            $stmt->bindParam(':image', $row_image, PDO::PARAM_STR, strlen($row_image));

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=projects');
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
        }
    }
} elseif ($row['id'] > 0) {
    $lang_module['projects_add'] = $lang_module['projects_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_projects WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }

    $array_images = !empty($row['image']) ? explode('|', $row['image']) : array();
} else {
    $row['id'] = 0;
    $row['title'] = '';
    $row['alias'] = '';
    $row['dientichxd'] = '';
    $row['thoigianxd'] = '';
    $row['thoigiangn'] = '';
    $row['vondautu'] = '';
    $row['chudautu'] = '';
    $row['dientich'] = '';
    $row['sophong'] = '';
    $row['soblock'] = '';
    $row['sotang'] = '';
    $row['socanho'] = '';
    $row['khonggianxanh'] = '';
    $row['matdo'] = '';
    $row['phiquanly'] = '';
    $row['giuoto'] = '';
    $row['giuxemay'] = '';
    $row['giaban'] = '';
    $row['giathue'] = '';
    $row['tienich'] = '';
    $row['noithat'] = '';
    $row['description'] = '';
    $row['descriptionhtml'] = '';
    $row['provinceid'] = 0;
    $row['districtid'] = 0;
    $row['wardid'] = 0;
	$row['address'] = '';
	$row['maps'] = '';
	$row['inhome'] = 0;
    $row['image'] = '';
}

if (defined('NV_EDITOR')) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
$row['descriptionhtml'] = htmlspecialchars(nv_editor_br2nl($row['descriptionhtml']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['descriptionhtml'] = nv_aleditor('descriptionhtml', '100%', '300px', $row['descriptionhtml']);
} else {
    $row['descriptionhtml'] = '<textarea style="width:100%;height:300px" name="descriptionhtml">' . $row['descriptionhtml'] . '</textarea>';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_FILE', $module_file);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('UPLOAD_PATH', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('UPLOAD_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=upload&token=' . md5($nv_Request->session_id . $global_config['sitekey']));
$xtpl->assign('MAXFILESIZEULOAD', 419430);
$xtpl->assign('MODULE_FILE', $module_file);

if ($row['id'] > 0) {
    $op = 'items';
} else {
    $xtpl->assign('RADIO_JS', "$('.thumb_booth:first .responstyle').addClass('box_img');");
}

$i = 0;
if (!empty($array_images)) {
    foreach ($array_images as $otherimage) {
        $xtpl->assign('DATA', array(
            'number' => $i,
            'basename' => $otherimage,
            'filepath' => NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $otherimage,
            'checked' => $row['homeimg'] == $otherimage ? 'checked="checked"' : '',
            'box_img' => $row['homeimg'] == $otherimage ? 'box_img' : '',
        ));
        $xtpl->parse('main.data');
        $i++;
    }
}

$xtpl->assign('COUNT', $i);
$xtpl->assign('COUNT_UPLOAD', 10 - $i);

$location = new Location();
$location->set('IsDistrict', 1);
$location->set('IsWard', 1);
$location->set('SelectProvinceid', $row['provinceid']);
$location->set('SelectDistrictid', $row['districtid']);
$location->set('SelectWardid', $row['wardid']);
$location->set('BlankTitleProvince', 1);
$location->set('BlankTitleDistrict', 1);
$location->set('BlankTitleWard', 1);
$location->set('ColClass', 'col-xs-24 col-sm-8 col-md-8');
$xtpl->assign('LOCATION', $location->buildInput());

 
if (! empty($array_config['maps_appid'])) {
	
    $xtpl->assign('MAPS_APPID', $array_config['maps_appid']);
    $xtpl->parse('main.maps');
} else {
    $xtpl->parse('main.required_maps_appid');
}
   
	

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

if (empty($row['id'])) {
    $xtpl->parse('main.auto_get_alias');
}

// lấy danh sách nội thất ra
$ds_noithat = $db->query('SELECT * FROM '. NV_PREFIXLANG . '_' . $module_data . '_furniture ORDER BY id DESC')->fetchAll();

if(!empty($ds_noithat))
{
	$mang_noithat = explode(',', $row['noithat']); 
	foreach($ds_noithat as $ti)
	{
		if(in_array($ti['id'],$mang_noithat))
		$xtpl->assign( 'checked', 'checked=checked');
		else $xtpl->assign( 'checked', '');
		$xtpl->assign( 'noithat', $ti );
		$xtpl->parse( 'main.noithat' );
	}

}
	
	// lấy danh sách tiện ích ra
$ds_tienich = $db->query('SELECT * FROM '. NV_PREFIXLANG . '_' . $module_data . '_convenient ORDER BY id DESC')->fetchAll();

if(!empty($ds_tienich))
{
	$mang_tienich = explode(',',$row['tienich']);
	foreach($ds_tienich as $ti)
	{
		if(in_array($ti['id'],$mang_tienich))
		$xtpl->assign( 'checked', 'checked=checked');
		else $xtpl->assign( 'checked', '');
		$xtpl->assign( 'tienich', $ti );
		$xtpl->parse( 'main.tienich' );
	}

}
$row['inhome'] = $row['inhome'] ? 'checked="checked"' : '';

$xtpl->parse('main');
$contents = $xtpl->text('main');

$set_active_op = 'projects';
$page_title = $lang_module['projects_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';