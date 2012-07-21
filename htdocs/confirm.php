<?php
session_start();

if( empty( $_SESSION['username' ] )){
    header('location:http://weby.orz.hm');
}


require_once('/home/weby/share/lib/ConfSmarty.php');

$smarty = new ConfSmarty();

// placeを判定する
$place_id = $_POST['place_id'];
switch($place_id){
    case 0:
        $place = "市ヶ谷健保会館";
        $address = "東京都新宿区市ヶ谷4-39　市ヶ谷健保会館";
        break;
    case 1:
        $place = "大久保健保会館";
        $address = "東京都新宿区百人町2-27-6 関東ＩＴソフトウェア健保会館";
        break;
    case 2:
        $place = "大沼家";
        $address = "i dont know";
        break;
    case 3:
        $place = "岡山家";
        $address = "東京都練馬区旭丘1-33-5-302";
        break;
    case 4:
        $place = $_POST['place'];
        $address = $_POST['address'];
        break;
    default:
        $smarty->display('error.tpl');
        exit;
}

$smarty->assign(array(
		      'name'  => $_POST['name'],
		      'desc'  => $_POST['desc'],
		      'date'  => $_POST['date'],
              'join' => $_POST['join'],
              'presen' => $_POST['presen'],
              'place' => $place,
//		      'm_join' => $_POST['m_join'],
//              'm_presen' => $_POST['m_presen'],
              'url'   => $address
		      ));

$smarty->display('confirm.tpl');
