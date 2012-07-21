<?php
//controller
//C
require_once '/home/weby/share/lib/ConfSmarty.php';
require_once '/home/weby/share/lib/DBIWrapper.php';

class showHistory{
    private $smarty = null; 

    function __construct()
	{
        $this->smarty = new ConfSmarty();
        $this->smarty->compile_check = true;
        $this->smarty->debugging = false;
        $this->smarty->caching = 0;        
    }

    public function getConfs($search = null, $limit = null, $types = null){
        $dbi = new DBIWrapper();
        $res = $dbi->searchConf($search, $limit, $types);
        if($res)
        {
            $this->smarty->assign('confs', $res);
        }else
        {
            //error
        }
    }

    public function getConf($c_id = null){
        $dbi = new DBIWrapper();
        $res = $dbi->getConf($c_id);
        if($res && is_array($res))
        {
            $this->smarty->assign('conf', $res[0]);
        }else
        {
            //error
        }
    }

    //ユーザリストを取得しassignする
    public function getUser($c_id = null){
        $dbi = new DBIWrapper();
        $res = $dbi->getUser($c_id);
        if($res && is_array($res))
        {
            $this->smarty->assign('users', $res);
        }else
        {
            //error
        }
    }

    //発表者のリストを取得しassignする
    public function getAnoUser($c_id = null){
        $dbi = new DBIWrapper();
        $res = $dbi->getUser($c_id, 1);
        if($res && is_array($res))
        {
            $this->smarty->assign('announcer', $res);
        }else
        {
            //error
        }
    }

    //参加者のリストを取得しassignする
    public function getAttUser($c_id = null){
        $dbi = new DBIWrapper();
        $res = $dbi->getUser($c_id, 0);
        if($res && is_array($res))
        {
            $this->smarty->assign('attendant', $res);
        }else
        {
            //error
        }
    }

    public function display()
    {
        $this->smarty->display('conference_history.tpl');
    }
}


session_start();
if(empty($_SESSION['username']))
{
    header('Location: http://weby.orz.hm/');
}


$c_id = null;
$search = null;

if (isset($_GET['c_num'])) {
    $c_id = $_GET['c_num'];
}

if (isset($_GET['q'])) {
    $search = $_GET['q'];
}

$show_history = new showHistory();
$show_history->getConfs($search);
$show_history->getConf($c_id);
$show_history->getUser($c_id);
$show_history->getAttUser($c_id);
$show_history->getAnoUser($c_id);
$show_history->display();
/*
echo($search);

require_once '/home/weby/share/lib/DBIWrapper.php';
$dbi = new DBIWrapper();
$users = $dbi->getConf(1);
if(!is_null($users)){
    echo("debug :\n " . var_export($users, true) . "\n");
}
*/
