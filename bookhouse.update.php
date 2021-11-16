<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 02 Dec 2015 08:26:04 GMT
 */
define('NV_SYSTEM', true);

// Xac dinh thu muc goc cua site
define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __file__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/includes/mainfile.php';
require NV_ROOTDIR . '/includes/core/user_functions.php';

// Duyệt tất cả các ngôn ngữ
$language_query = $db->query('SELECT lang FROM ' . $db_config['prefix'] . '_setup_language WHERE setup = 1');
while (list ($lang) = $language_query->fetch(3)) {
    $mquery = $db->query("SELECT title, module_data FROM " . $db_config['prefix'] . "_" . $lang . "_modules WHERE module_file = 'bookhouse'");
    while (list ($mod, $mod_data) = $mquery->fetch(3)) {
        $_sql = array();

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block( bid smallint(5) unsigned NOT NULL, id int(11) unsigned NOT NULL, weight int(11) unsigned NOT NULL, UNIQUE KEY bid (bid,id) ) ENGINE=MyISAM";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat( bid smallint(5) unsigned NOT NULL AUTO_INCREMENT, adddefault tinyint(4) NOT NULL DEFAULT '0', numbers smallint(5) NOT NULL DEFAULT '10', title varchar(250) NOT NULL DEFAULT '', alias varchar(250) NOT NULL DEFAULT '', image varchar(255) DEFAULT '', description varchar(255) DEFAULT '', weight smallint(5) NOT NULL DEFAULT '0', keywords text, add_time int(11) NOT NULL DEFAULT '0', edit_time int(11) NOT NULL DEFAULT '0', PRIMARY KEY (bid), UNIQUE KEY title (title), UNIQUE KEY alias (alias) ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('structure_upload', 'Ym'), ('structure_upload_user', 'username_Y');";

//         $_sql[] = "UPDATE " . $db_config['prefix'] . "_setup_extensions SET version='2.0.00 " . NV_CURRENTTIME . "' WHERE type='module' and basename=" . $db->quote($mod);

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('sizetype', '0');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD size_v DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER area, ADD size_h DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER size_v;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " CHANGE area area DOUBLE NOT NULL DEFAULT '0';";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " CHANGE price price DOUBLE NOT NULL DEFAULT '0';";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD structure TINYTEXT NOT NULL AFTER homeimgalt;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD price_time TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER price;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('priceformat', '0');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD type TINYTEXT NOT NULL AFTER structure;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('view_on_main', '0');";

//         $_sql[] = "UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config SET config_value = 'viewgrid' WHERE config_name = 'display_type';";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('display_data', '0');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_categories ADD lev SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER groups_view, ADD sort SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER lev;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_categories ADD numsub SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER sort, ADD subid VARCHAR(255) NOT NULL AFTER numsub;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('dec_point', '.'), ('thousands_sep', ',');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('othertype', '0');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('maps_appid', '');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('pricetype', '0');";

//         // v2.0.01
//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects(
//           id mediumint(4) unsigned NOT NULL AUTO_INCREMENT,
//           title varchar(250) NOT NULL,
//           alias varchar(250) NOT NULL,
//           description text NOT NULL,
//           descriptionhtml text NOT NULL,
//           status tinyint(1) NOT NULL DEFAULT '1',
//           PRIMARY KEY (id),
//           UNIQUE KEY alias (alias)
//         ) ENGINE=MyISAM";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD projectid MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER money_unit;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD front DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER homeimgalt, ADD road DOUBLE UNSIGNED NOT NULL DEFAULT '0' AFTER front;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD exptime INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER edittime;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_queue_logs( id int(11) unsigned NOT NULL AUTO_INCREMENT, itemid int(11) unsigned NOT NULL, queue tinyint(1) unsigned NOT NULL DEFAULT '1', reason text NOT NULL, reasonid tinyint(2) unsigned NOT NULL DEFAULT '0', addtime int(11) unsigned NOT NULL, userid int(11) NOT NULL, PRIMARY KEY (id) ) ENGINE=MyISAM";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_queue_reason( id smallint(4) unsigned NOT NULL AUTO_INCREMENT, title varchar(255) NOT NULL, note tinytext NOT NULL COMMENT 'Ghi chú', weight smallint(4) unsigned NOT NULL DEFAULT '0', status tinyint(1) NOT NULL COMMENT 'Trạng thái', PRIMARY KEY (id) ) ENGINE=MyISAM";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat ADD useradd TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER bid;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat ADD color VARCHAR(10) NOT NULL AFTER description;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD ordertime INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER showprice";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('refresh_allow', '0'), ('refresh_config', '');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD contact_fullname VARCHAR(150) NOT NULL AFTER showprice;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD contact_email VARCHAR(100) NOT NULL AFTER contact_fullname;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD contact_phone VARCHAR(20) NOT NULL AFTER contact_email;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD contact_address VARCHAR(255) NOT NULL AFTER contact_phone;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('allow_contact_info', '0');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('itemsave', '1');";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_saved( userid int(11) unsigned NOT NULL, itemid int(11) unsigned NOT NULL, UNIQUE KEY userid (userid,itemid), KEY userid_2 (userid,itemid) ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('refresh_default', '0');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('payport', '0');";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_refresh(
//           userid int(11) unsigned NOT NULL,
//           count int(11) unsigned NOT NULL DEFAULT '0',
//           UNIQUE KEY userid (userid)
//         ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('specialgroup_config', '');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block ADD exptime INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER id;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_type( id smallint(4) unsigned NOT NULL AUTO_INCREMENT, title varchar(255) NOT NULL, note text NOT NULL, weight smallint(4) unsigned NOT NULL DEFAULT '0', status tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái', PRIMARY KEY (id) ) ENGINE=MyISAM";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD typeid SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER money_unit;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_type_catid( typeid smallint(4) unsigned NOT NULL, catid smallint(4) unsigned NOT NULL, UNIQUE KEY typeid (typeid, catid) ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('code_auto', '0'), ('code_format', 'T%06s');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD group_config TEXT NOT NULL AFTER groupid;";

//         $result = $db->query("SELECT id FROM " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data);
//         while ($row = $result->fetch()) {
//             $_result = $db->query("SELECT bid, exptime FROM " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block WHERE id=" . $row['id']);
//             $list_bid = array();
//             while (list ($bid, $exptime) = $_result->fetch(3)) {
//                 $list_bid[$bid] = $exptime;
//             }
//             if (!empty($list_bid)) {
//                 $_sql[] = "UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " SET group_config=" . $db->quote(serialize($list_bid)) . ' WHERE id=' . $row['id'];
//             }
//         }

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " DROP groupid;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD prior INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER contact_address;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat ADD prior SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0' AFTER useradd;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('refresh_free', '0');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_refresh ADD free SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER count, ADD free_time INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER free;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat ADD groups smallint(5) NOT NULL AFTER color;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('payment_style', '0');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('upgrade_group_config', '');";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_users_groups( userid int(11) unsigned NOT NULL, groupid smallint(4) unsigned NOT NULL DEFAULT '0', exptime int(11) unsigned NOT NULL DEFAULT '0', UNIQUE KEY userid (userid) ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('upgrade_group_percent', '0');";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('similar_content', '80'), ('similar_time', '5');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_queue_logs CHANGE userid userid INT(11) NOT NULL DEFAULT '0';";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_mail_queue( id smallint(4) unsigned NOT NULL AUTO_INCREMENT, tomail varchar(100) NOT NULL, subject varchar(255) NOT NULL, message text NOT NULL, PRIMARY KEY (id) ) ENGINE=MyISAM";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('refresh_auto_config', '');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block_cat ADD cron_time INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER edit_time;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_econtent( action varchar(100) NOT NULL, econtent text NOT NULL, PRIMARY KEY (action) ) ENGINE=MyISAM;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_econtent (action, econtent) VALUES('upgrade_group', '')";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_econtent (action, econtent) VALUES('group', '')";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config CHANGE config_value config_value TEXT NOT NULL;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('auto_resize', '1');";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_pricetype(
//         id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
//         title varchar(255) NOT NULL,
//         note text NOT NULL,
//         weight smallint(4) unsigned NOT NULL DEFAULT '0',
//         status tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái',
//         PRIMARY KEY (id)
//         ) ENGINE=MyISAM;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_pricetype_typeid(
//         pricetypeid smallint(4) unsigned NOT NULL,
//         typeid smallint(4) unsigned NOT NULL,
//         UNIQUE KEY pricetypeid (pricetypeid, typeid)
//         ) ENGINE=MyISAM;";

//         $_sql[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_review(
//           review_id int(11) unsigned NOT NULL AUTO_INCREMENT,
//           bookhouse_id int(11) NOT NULL DEFAULT '0',
//           userid int(11) NOT NULL DEFAULT '0',
//           sender varchar(250) NOT NULL,
//           content text NOT NULL,
//           rating int(1) NOT NULL,
//           add_time int(11) NOT NULL DEFAULT '0',
//           edit_time int(11) NOT NULL DEFAULT '0',
//           status tinyint(1) NOT NULL DEFAULT '0',
//           PRIMARY KEY (review_id)
//         ) ENGINE=MyISAM";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects ADD provinceid MEDIUMINT(4) UNSIGNED NOT NULL AFTER descriptionhtml, ADD districtid MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER provinceid, ADD wardid MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' AFTER districtid;";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('money_unit', 'đ');";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block ADD refresh_time_last INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER exptime;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block ADD  refresh_time_next INT( 11 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  refresh_time_last";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_block ADD  refresh_lasttime INT( 11 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  refresh_time_next";

//         $_sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $mod . "', 'time_reloadpage', 10)";

//         $_sql[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $mod . "', 'refresh_next_time', " . NV_CURRENTTIME . ")";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects ADD typeid SMALLINT(4) UNSIGNED NOT NULL DEFAULT '0' AFTER id;";

        $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects ADD homeimg VARCHAR(255) NOT NULL COMMENT 'Ảnh đại diện' AFTER wardid;";

        $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects CHANGE image image TEXT NOT NULL COMMENT 'Hình ảnh';";

        $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects ADD image VARCHAR(255) NOT NULL AFTER wardid;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD way_balcony_id smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Hướng ban công' AFTER way_id;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD floor smallint(2) NOT NULL DEFAULT '0' AFTER catid;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD bedroom smallint(2) NOT NULL DEFAULT '0' AFTER floor;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD toilet smallint(2) NOT NULL DEFAULT '0' AFTER bedroom;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD interior varchar(255) NOT NULL DEFAULT '' AFTER toilet;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " ADD begin_time int(11) unsigned NOT NULL DEFAULT '0' AFTER exptime;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " DROP end_time;";

//         $_sql[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " CHANGE begin_time publtime int(11) unsigned NOT NULL DEFAULT '0';";

//         $_sql[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_config (config_name, config_value) VALUES ('review_check', '1');";

//         $result = $db->query("SELECT id, addtime FROM " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data);
//         while (list ($id, $addtime) = $result->fetch(3)) {
//             $_sql[] = "UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " SET publtime=" . $addtime . " WHERE id=" . $id . " AND publictime!=0";
//         }

        $result = $db->query("SELECT id, image FROM " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . '_projects');
        while (list ($id, $images) = $result->fetch(3)) {
            $db->query("UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . "_projects SET homeimg='" . $images . "' WHERE id=" . $id );
        }

        if (!empty($_sql)) {
            foreach ($_sql as $sql) {
                try {
                    $db->query($sql);
                } catch (PDOException $e) {
                    //trigger_error($e->getMessage());
                }
            }
            $nv_Cache->delMod($mod);
        }

        $result = $db->query('SELECT id, addtime FROM ' . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . ' WHERE ordertime=0');
        while (list ($id, $addtime) = $result->fetch(3)) {
            $_sql[] = "UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $mod_data . " SET ordertime=" . $addtime . ' WHERE id=' . $id;
        }
    }
}

die('OK');
