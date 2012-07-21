<?php
session_start();

//prepared smarty
require_once('/home/weby/share/lib/ConfSmarty.php');

$smarty = new ConfSmarty();

$smarty->compile_check = false;
$smarty->debugging = false;


// ログインしてない。またはc_idがない。
if (empty($_SESSION['username']) || empty( $_SESSION['conference'])){
	header('location: http://weby.orz.hm/');
    exit;
}


// 現在のユーザデータ表示ぐらいはしようか。
$c_id = $_SESSION['conference']['c_id'];
$c_max = $_SESSION['conference']['c_m_join'];
require_once '/home/weby/share/lib/DB.php';

$db = new DB('localhost','weby','mece','weby');
$sql = 'select u_name, u_launch from usr where c_id='.$c_id.' order by u_id';
if( !$db->query($sql) || ( $u_data = $db->fetch() ) === FALSE ){
	
	// DBエラーなので終わり
	$db->close();
	
	// errorテンプレートの表示
	$smarty->display('error.tpl');
	exit;
}
$db->close();

// パラメータが正常取得出来たのでセットしときましょう
$smarty->assign('u_data', $u_data);
$smarty->assign('c_id', $c_id);
$smarty->assign('c_max', $c_max);


// 空であれば入力画面
if( empty($_POST['status']) ) $smarty->display('join/joinConf_reg.tpl');

// 確認画面
else if($_POST['status'] == 'confirm') join_confirm($smarty);

// 完了画面
else if($_POST['status'] == 'done') join_done($c_id, $smarty);


function join_confirm($smarty){
	$flg = true;
	
	// データの取得
	if( empty( $_POST['u_name']) ) $flg = false; 
	else $u_name = $_POST['u_name'];
	
	// 発表者フラグ
	if( empty( $_POST['u_type'] ) ) $u_type = 0;
	else $u_type = 1; 
	
  // 発表者ランチ
  if( empty($_POST['u_launch'])) $u_launch = 0;
  else $u_launch = 1;

	//発表者用データの取得
	if(empty($_POST['u_title']) && $u_type == 1)  $flg = false;
	else $u_title = $_POST['u_title'];
	
	if(empty($_POST['u_desc']) && $u_type == 1)  $flg = false;
	else $u_desc = $_POST['u_desc'];

	// テンプレートの変数設定
	$smarty->assign('u_name', escape($u_name));
	$smarty->assign('u_type', $u_type);
  $smarty->assign('u_launch', $u_launch);
	$smarty->assign('u_title', escape($u_title));
	$smarty->assign('u_desc', escape($u_desc));
	
	// テンプレートの設定
	if($flg) $smarty->display('join/joinConf_con.tpl');
	else $smarty->display('join/joinConf_reg.tpl');
}

function join_done($c_id, $smarty){
	//sql文の生成
	$sql = "insert into usr(u_name, u_type, u_title, u_desc, c_id, u_pict, u_launch)";
	$sql .= "values('".escape($_POST['u_name'])."',".$_POST['u_type'].",'".escape($_POST['u_title'])."','".escape($_POST['u_desc'])."',".$c_id.",'none',".$_POST['u_launch'].")";

	//DBに格納
	$db = new DB('localhost','weby','mece','weby');
	if($db->query($sql)) $smarty->display('join/joinConf_done.tpl');
	else $smarty->display('error.tpl');
}

function escape($string){
	// escape of escape
    $string = str_replace("<br>", "\n", $string);
    // escape
    $string = str_replace("&", "&amp;", $string);
    $string = str_replace("<", "&lt;", $string);
    $string = str_replace(">", "&gt;", $string);
    $string = str_replace("'", "", $string);
    $string = str_replace(array("\r\n", "\n", "\r"), "<br>", $string);
	return $string;
}
