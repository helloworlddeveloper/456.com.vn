<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2016 mynukeviet. All rights reserved
 * @Createdate Sun, 20 Nov 2016 07:31:04 GMT
 */
if (! defined('NV_IS_MOD_BOOKHOUSE'))
    die('Stop!!!');

// Xóa tin hết hạn khỏi block
if ($nv_Request->isset_request('groupdel', 'get')) {
    try {
        $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE exptime < ' . NV_CURRENTTIME);
        while ($row = $result->fetch()) {
            $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE bid=' . $row['bid'] . ' AND id=' . $row['id']);
            if ($count) {
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET group_config = "" WHERE id=' . $row['id']);
                // $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET group_id = 0 WHERE id=' . $row['id']);
            }
        }
        $nv_Cache->delMod($module_name);
    } catch (Exception $e) {
        trigger_error($e->getMessage());
    }
} else {
    // Gửi mail trong hàng đợi
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_mail_queue');
    while ($row = $result->fetch()) {
        $from = array(
            $global_config['site_name'],
            $global_config['site_email']
        );
        
        if (nv_sendmail($from, $row['tomail'], $row['subject'], $row['message'])) {
            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_mail_queue WHERE id=' . $row['id']);
        }
    }
    
    // Tự động làm mới
    if (! empty($array_config['refresh_auto_config'])) {
        $refresh_auto_config = unserialize($array_config['refresh_auto_config']);
        foreach ($refresh_auto_config as $groupid => $min) {
            if (! empty($min)) {
                if ((NV_CURRENTTIME - $array_groups[$groupid]['cron_time']) > ($min * 60)) {
                    $result = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE bid=' . $groupid . ' AND (exptime = 0 OR exptime > ' . NV_CURRENTTIME . ')');
                    while (list ($id) = $result->fetch(3)) {
                        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET ordertime=' . NV_CURRENTTIME . ' WHERE id=' . $id);
                        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET cron_time=' . NV_CURRENTTIME . ' WHERE bid=' . $groupid);
                    }
                }
            }
        }
        $nv_Cache->delMod($module_name);
    }
}
