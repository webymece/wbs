<?php
session_start();
if(empty($_SESSION['username'])){
    header('Location: http://weby.orz.hm');
}


require_once('/home/weby/share/lib/ConfSmarty.php');
$smarty = new ConfSmarty();


//Open mysql DB
require_once '/home/weby/share/lib/DB.php';
$db = new DB('localhost', 'weby', 'mece', 'weby');

//ユーザIDから、ユーザ名と、会議名を引きたい
$sql = 'select * from usr where u_id=\''.$_GET['u_id'].'\'';
if( !$db->query($sql) || ( $u_data = $db->fetch() ) === FALSE){

    //DB読込エラー error画面へ
    $db->close();

    // errorの出力とerror画面の出力
    error_log('[DB ERROR]'.__FILE__.':'.__LINE__.' can not get user data from mysql');
    $smarty->display('error.tpl');
    exit;
}
$db->close();


$smarty->assign(array('u_id' => $_GET['u_id'] ));
$smarty->assign('u_name', $u_data[0]['u_name']);
$smarty->assign('c_id', $_SESSION['conference']['c_id']);
$smarty->assign('c_name', $_SESSION['conference']['c_name']); 
$smarty->display('joinCancel.tpl');
