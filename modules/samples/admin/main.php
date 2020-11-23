<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];
$post = $error = [];


// $image->save(NV_UPLOADS_REAL_DIR, $newname, $quality);
// $image->close();

// $info = $image->create_Image_info;

if($nv_Request->isset_request("change_provide", "post,get")){
    $id_provide = $nv_Request->get_int("id_provide", "post,get", 0);
    if($id_provide > 0){
        $sql = "SELECT id, title FROM `nv4_vi_location_district` WHERE idprovince = ".$id_provide." ORDER BY weight ASC";
//         SELECT * FROM `nv4_vi_location_district`WHERE idprovince =101
        $result = $db->query($sql);
        $html='<option value="0">Chọn huyện</option>';
        
        while($province = $result->fetch()){
            $html .= '<option value="'.$province['id'].'">'.$province['title'].' </option>';
        }die($html);
        
    }else{
        die("sai");
    }
}  
$post['id'] = $nv_Request->get_int('id', "post,get",0);


if($nv_Request->isset_request("submit", "post")){
    
    $post['title'] = $nv_Request->get_title('title', "post",'');
    $post['email'] = $nv_Request->get_title('email', "post",'');
    $post['phone'] = $nv_Request->get_title('phone', "post",'');
    $post['gender'] = $nv_Request->get_int('gender', "post", 0);
    $post['provider'] = $nv_Request->get_int('provider', "post", 0);
    $post['district'] = $nv_Request->get_int('district', "post", 0);
   
    if(isset($_FILES, $_FILES['avt'], $_FILES['avt']['tmp_name']) and is_uploaded_file($_FILES['avt']['tmp_name'])){

        $upload = new NukeViet\Files\Upload($admin_info['allow_files_type'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
        $upload->setLanguage($lang_global);
        $upload_info = $upload->save_file($_FILES['avt'], NV_UPLOADS_REAL_DIR, false, $global_config['nv_auto_resize']);
    }
    
    if ($post['title'] == ''){
        $error[] = $lang_module['error_title'];
    }
    
    if ($post['email'] == ''){
        $error[] = $lang_module['error_email'];
//     }else if(!preg_match("/^(.*?)@(.*?)/", $post[email])){
//         $error[] = $lang_module['error_emails'];
    }
    
    if ($post['phone'] == ''){
        $error[] = $lang_module['error_phone'];
    }
//     else if(!preg_match("/[0-9]{10|11}/", $post[phone])){
//         $error[] = $lang_module['error_phones'];
//     }
    

    
    if(empty($error)){  
        if ($post['id']>0){
            //update
            $sql = "UPDATE `nv4_vi_samples`  SET `title`= :title, `avt`= :avt, `email`=:email, `phone`=:phone, `gender`=:gender, `provider`=:provider, `district`=:district, `updatetime`=:updatetime WHERE id =".$post['id']; 
            $s = $db->prepare($sql);
            $s->bindValue('updatetime', 0);
        }else{
            //Insert
            $sql = "INSERT INTO `nv4_vi_samples` ( `title`,`avt` ,`email`, `phone`, `gender`, `provider`, `district`, `addtime`, `weight`,`active`) VALUES ( :title, :avt, :email, :phone, :gender, :provider, :district, :addtime, :weight, :active)";
            $s = $db->prepare($sql);
            
//             print_r($sql);die();
            $sql = "SELECT count(*) FROM `nv4_vi_samples`";
            $weight = $db->query($sql)->fetchColumn();$weight = $weight +1;
            
            $s->bindParam('weight', $weight);
            $s->bindValue('active', 1);
            $s->bindValue('addtime', NV_CURRENTTIME);
        }
            $s->bindParam('title', $post['title']);
            $s->bindParam('avt',  $upload_info['basename']);
            $s->bindParam('email', $post['email']);
            $s->bindParam('phone', $post['phone']);
            $s->bindParam('gender', $post['gender']);
            $s->bindParam('provider', $post['provider']);
            $s->bindParam('district', $post['district']);

            $exe = $s->execute();
            if($exe){
                if($post['id']>0){
                    $error[] = $lang_module['update_suc'];
                }else{
                    $error[] = $lang_module['insert_suc'];
                }
            }
            }else{
                $error[] = $lang_module['error_'];
            }     
           
}else if($post['id']>0){
    //Tồn tại id thì hiện dữ liệu của id đấy
    $sql = "SELECT * FROM `nv4_vi_samples` WHERE id = " .$post['id'];
    $post = $db->query($sql)->fetch();
}else{
    $post['title'] = '';
    $post['email'] = '';
    $post['avt'] = '';
    $post['phone'] = '';
    $post['gender'] = 3;
    $post['provider'] = 0;
    $post['district'] = 0;
    
}


   
//------------------------------
// Viáº¿t code xá»­ lÃ½ chung vÃ o Ä‘Ã¢y
//------------------------------

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

$xtpl->assign('ERROR', implode('</br>',$error));



foreach($array_gender as $key => $gender){
    $xtpl->assign('GENDER',array(
        'key' => $key,
        'title' => $gender,
        'checked'=> $key == $post['gender'] ? 'checked="checked" ' : ''
    ));
    $xtpl->parse('main.gender');
} 

foreach($array_province as $key => $province){
    $xtpl->assign('PROVINCE',array(
        'key' => $key,
        'title' => $province['title'],
        'selected'=> $key = $post['provider'] ? 'selected="selected" ' : ''
    ));
    $xtpl->parse('main.provider');
}

$xtpl->assign('POST', $post);
                

if(!empty($error)){
    $xtpl->parse('main.error');
}
//-------------------------------
// Viáº¿t code xuáº¥t ra site vÃ o Ä‘Ã¢y
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
