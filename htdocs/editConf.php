<?php
session_start();

require_once('/home/weby/share/lib/ConfSmarty.php');

$smarty = new ConfSmarty();

$smarty->compile_check = false;
$smarty->debugging = false;


// error確認
if( empty ( $_SESSION['username'] ) || empty ( $_SESSION['conference'] ) ){
	$smarty->display('error.tpl');
	exit;	
}

// c_idから編集する会議を決定する
$c_id = $_SESSION['conference']['c_id'];

// MySQLの準備
require_once '/home/weby/share/lib/DB.php';

$db = new DB('localhost', 'weby', 'mece', 'weby');

$sql = 'select * from conference order by c_id desc';
if( !$db->query($sql) || ($c_data = $db->fetch())===false ){
	$db->close();
	$smarty->display('error.tpl');
	exit;
}

$smarty->assign('all_list', $c_data);
$smarty->assign('c_id', $c_id);


// 本当は一度データ取り出して精査した方がよかです
// 最初の編集画面へ
if( empty($_POST['status']) ) display_edit_conf($c_id, $smarty);

// 完了画面へ(確認はJSでやる。)
else if($_POST['status'] == 'done') edit_done($c_id, $smarty);

// 想定外のデータ。エラーへ。
else $smarty->display('error.tpl');


/**
 * 編集ページの表示
 */
function display_edit_conf($c_id, $smarty){
	$db = new DB('localhost', 'weby', 'mece', 'weby');

	$sql = 'select * from conference where c_id = '.$c_id;
	if( !$db->query($sql) || ( $c_data = $db->fetch()) === false ){
		$smarty->display('error.tpl');
		exit;
	}
	
	// テンプレートに格納
	$smarty->assign('name', $c_data[0]['c_name']);
	$smarty->assign('desc', $c_data[0]['c_desc']);
	$smarty->assign('date', $c_data[0]['c_date']);
	$smarty->assign('place', $c_data[0]['c_place']);
	$smarty->assign('m_join', $c_data[0]['c_m_join']);
	$smarty->assign('m_presen', $c_data[0]['c_m_presen']);
	$smarty->assign('url', $c_data[0]['c_map_url']);
	
	//テンプレの表示
	$smarty->display('edit/editConf_reg.tpl');
	
	// DB閉じる
	$db->close();
}

/**
 * DBへの登録と完了画面の表示
 */
function edit_done($c_id, $smarty){
	// データ取得 本来ならセキュリティを考えたいとこだが。。
	$c_name = $_POST['name'];
	$c_desc = $_POST['desc'];
	$c_date = $_POST['date'];
	$c_place = $_POST['place'];
	$c_m_join = $_POST['m_join'];
	$c_m_presen = $_POST['m_presen'];
	$c_map_url = $_POST['address'];
		
	// インスタンスとクエリの生成
	$db = new DB('localhost', 'weby', 'mece', 'weby');
	$sql = "update conference set c_name='".$c_name."', c_desc='".$c_desc."', c_date='".$c_date."', c_place='".$c_place."',";
	$sql .= "c_m_join=".$c_m_join.", c_m_presen=".$c_m_presen.", c_map_url='".$c_map_url."' where c_id=".$c_id;
	
	// クエリの実行とテンプレの表示
	if($db->query($sql)) $smarty->display('edit/editConf_done.tpl');
	else $smarty->display('error.tpl');
	
	// DB閉じる
	$db->close();
}
