<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['config'];

if($nv_Request->isset_request("action", "post,get")){
    $id = $nv_Request->get_int('id', "post,get", 0);
    
    $checksess = $nv_Request->get_title('checksess', "post,get",'');
    
    if($id > 0 and $checksess == md5($id. NV_CHECK_SESSION)){
        die("abc");
        $sql = "DELETE FROM `nv4_vi_album` WHERE id = " .$id ;
//                print_r($sql);
//                die("err");
        $db->query($sql);
//        
    }
}

if($nv_Request->isset_request("change_active", "post,get")){
    $id = $nv_Request->get_int('id', "post,get", 0);
    $sql="SELECT id, active FROM `nv4_vi_album` WHERE id = ".$id;
    $result =$db->query($sql);
    if($row = $result->fetch() ){
        $active =$row['active'] == 1 ? 0 : 1;
        
        $exe = $db->query("UPDATE `nv4_vi_samples` SET active=" . $active . " WHERE id =".$id);
        if($exe){
            die("OKE");
        }
    }
    die("ERROR");
}

// $db->sqlreset()
//     ->select('*')
//     ->from("nv4_vi_album")
//     ->order("id ASC");

//     $sql= $db->sql();
//     $result = $db->query($sql);
//     $array_row = $result->fetchAll();

    
    
    $perpage = 5;
    $page= $nv_Request->get_int('page', "get", 1 );
    
    
    $db->sqlreset()
    ->select('COUNT(*)')
    ->from("nv4_vi_album");
    
    $sql = $db->sql();
    $total = $db->query($sql)->fetchColumn();
    
    $db->select('*')
    ->order("id ASC")
    ->LIMIT($perpage)
    ->offset(($page -1) * $perpage);
    
    $sql = $db->sql();
    $result = $db->query($sql);
    while($row=$result->fetch()){
        $array_row[$row['id']]=$row;
    }
//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

if(!empty($array_row)){
    $i=($page -1) * $perpage;
    foreach ($array_row as $key => $row){
        $row['stt'] = $i +1;
        $row['url_delete'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=list&amp;id='. $row['id'] .  '&action=delete&checksess=' .md5($row['id']). NV_CHECK_SESSION ;
        
        $row['url_edit'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=main&amp;id='. $row['id'];
        
        $row['url_detail'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=main&amp;id='. $row['id'];
        
        $row['avt'] = NV_BASE_SITEURL.NV_UPLOADS_DIR.'/'.$row['avt'];

        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.loop');
        $i++;
    }
}

$base_url = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=list';
$generate_page = nv_generate_page($base_url, $total, $perpage, $page);
$xtpl->assign('GENERATE_PAGE', $generate_page);


// if(!empty($array_row)){
//     foreach ($array_row as $key => $row){
//         $xtpl->assign('ROW', $row);
//         $xtpl->parse('main.loop');
//     }
// }
//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
