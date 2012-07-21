<?php
session_start();
/**
 * last update 2011/10/15
 * author akihiro_ob
 *
 */

//prepared smarty
require_once '/home//weby/share/lib/ConfSmarty.php';

$smarty = new ConfSmarty();

$smarty->compile_check = false;
$smarty->debugging = false;


/**
 * session管理。。結局やるのかよ。。
 * ログインとセッションはかなり適当なソースです。
 * 後日、改修する際に改めて書き直すので今はごめんなさい。。
 */
if( !empty($_POST['username']) && !empty($_POST['password']) ){
    if($_POST['username'] == 'weby' && $_POST['password'] == 'mece') 
        $_SESSION['username'] = 'weby';
}

if( empty($_SESSION['username']) ){
    $title = 'weby出欠管理システム login';
    $smarty->display('login.tpl');
    exit;
}


//get data from mysql
require_once '/home/weby/share/lib/DB.php';
$db = new DB('localhost', 'weby', 'mece', 'weby');

// 一番新しい会議情報を取得
$sql = 'select * from conference order by c_id desc limit 1';
if( !$db->query($sql) || ($c_data =$db->fetch() ) === FALSE){
    // DB読込エラー error画面へ
    $db->close();
    
    // errorの出力とerror画面の出力
    error_log('[DB ERROR]'.__FILE__.':'.__LINE__.' can not get conference data from mysql');
    $smarty->display('error.tpl');
    exit;
}

// 会議情報からその会議に参加しているユーザを取得
$sql = 'select * from usr where c_id='.$c_data[0]['c_id'].' order by u_id';
if( !$db->query($sql) || ( $u_data = $db->fetch() ) === FALSE){
    //DB読込エラー error画面へ
    $db->close();
    
    // errorの出力とerror画面の出力
    error_log('[DB ERROR]'.__FILE__.':'.__LINE__.' can not get user data from mysql');
    $smarty->display('error.tpl');
    exit;
}

// 正常終了
$db->close();

// ユーザ情報から発表者の情報だけ抜き取る
$p_data = array();
foreach ($u_data as $key => $value) {
    if($value['u_type'] == true) array_push($p_data,$value);
}

//データの格納
$smarty->assign('wiki_flg', 'true');
$smarty->assign('c_data', $c_data[0]);
$smarty->assign('u_data', $u_data);
$smarty->assign('p_data', $p_data); 
$_SESSION['conference'] = $c_data[0];

// テンプレートの表示
$smarty->display('index.tpl');

