<?PHP

//TODO 関数名に規則性を持たせる
//DBのラッパー
require_once '/home/weby/share/lib/DB.php';

class DBIWrapper {

    private $db = null; 
    function __construct()
	{
        //$db = new DB();
    }

    //TODO エラー処理はDB()でやってくれているから消すかどうか検討中
    //open close execute fetch
    private function open()
    {
        //openしてた時の処理
        //if()
        $this->db = new DB('localhost', 'weby', 'mece', 'weby');
        //if(true) error_log("error");
    }

    private function close()
    {
        $res = $this->db->close();
        //error log $db =null
        return $res;
    }

    private function execute($sql)
    {
        $res = $this->db->query($sql);
        //error log close
        return $res;
    }

    private function fetch()
    {
        $res = $this->db->fetch();
        //error log close
        return $res;
    }

    //select系

    //会議検索
    //$search = 検索文字列
    //limit   = 取得数
    //types    = 検索する対象
    //types = array("c_name", "u_name")だとユーザ名と会議名で検索を行う
    public function searchConf($search = null, $limit = null, $types = null)
    {
        if(is_null($limit) || $limit <= 0)
            $limit_str = "";
        else
            $limit_str = " limit ". $limit;
       
        if(is_null($types))
            $types = array('c_desc', 'c_name', 'u_desc', 'u_name', 'u_title');
        
        $type_str = "";
        foreach($types as $key => $value){
            if($key == 0)
                $type_str .= " where ";
            else 
                $type_str .= " or ";

            if($value == "c_desc" || $value == "c_name")
                $type_str .=  $value ." like '%".$search."%'";     
            if($value == "u_name" || $value == "u_desc" || $value == "u_title")
                $type_str .=  "c_id in ( select c_id from usr where ".$value." like '%".$search."%')";
        }

        $tmp_sql = "select distinct * from conference %s order by c_id desc %s";

        $this->open();
        if (is_null($search) )
            $sql = sprintf($tmp_sql,"",$limit_str);
        else {
            $sql = sprintf($tmp_sql, $type_str, $limit_str);
        }
        $res = $this->execute($sql);
        
        $result = $this->fetch();

        $this->close();

        return $result;
    }

    //$c_id番目のユーザ情報を取得する
    //引数が指定されていない場合は1番目を取得する
    //$type = 0　　のとき参加者のみ
    //$type = 1　　のとき発表者のみ
    //$type = null のときすべてのユーザ
    public function getUser($c_id = null, $type = null){
        
        $type_str = "";

        if(!is_null($type))
            $type_str = " and u_type = ".$type;   

        $this->open();
        if((is_null($c_id)))
            $sql = "select * from usr where c_id = (select c_id from conference order by c_id desc limit 1)" . $type_str;
        else
            $sql = "select * from usr where c_id = " . $c_id . "" . $type_str;

        $res = $this->execute($sql);
        
        $result = $this->fetch();

        $this->close();

        return $result;
    }

    //$c_id番目の会議情報を取得する
    //引数が指定されていない場合は1番目を取得する
    public function getConf($c_id = null){
        $this->open();
        if(is_null($c_id))
            $sql = 'select * from conference order by c_id desc limit 1';
        else
            $sql = "select * from conference where c_id = " . $c_id ." limit 1";
        //select * from usr where c_id = 2;

        $res = $this->execute($sql);
        
        $result = $this->fetch();

        $this->close();

        return $result;
    }

    //insert系
    //引数
    //comment,user_id,parent_id,conf_id
    /*
    public function addComent($comment, $u_id, $p_id, $c_id = ""){
        //validate
        //$comment,$u_id, $p_id

        if ($this->open()) return false;

        //insert sql

        $res = $this->execute($sql);
        
        if(!$res) return false;

        $result = $this->fetch();

        if(!$res) return false;

        $this->close();

        return $result;
    }
    */

    /*
            $this->smarty->assign('announcer', $announcer);
            $this->smarty->assign('attendant', $attendant);
    */
}

/*
 * 使い方
 */
/*

//
//select * from conference order by c_id desc
//会議の一覧を取得
$smarty = new ConfSmarty();
$dbi = new DBIWrapper();
$res = $dbi->searchConf();
if($res)
    $smarty->assign('confs', $res);
else
    //error処理

//
//select * from conference order by c_id desc limit 1
//最新の会議を取得
$smarty = new ConfSmarty();
$dbi = new DBIWrapper();
$res = $dbi->getConf();
if($res)
    $smarty->assign('conf', $res);
else
    //error処理

//
//select * from usr where c_id = 2
//2番目の会議に出席したユーザの取得
$smarty = new ConfSmarty();
$dbi = new DBIWrapper();
$res = $dbi->getUser(2);
if($res)
    $smarty->assign('user', $res);
else
    //error処理


//
//select * from usr where c_id = 3 and u_type = 1
//3番目の会議に出席したユーザで発表者だけ取得
$smarty = new ConfSmarty();
$dbi = new DBIWrapper();
$res = $dbi->getUser(3, 1);
if($res)
    $smarty->assign('user', $res);
else
    //error処理

//
//会議検索
//検索文字=けんさく、取得数=最大、ユーザ名と会議タイトル名から検索
$smarty = new ConfSmarty();
$dbi = new DBIWrapper();
$res = $dbi->searchConf("けんさく", null, array('c_name', 'u_name'));
if($res)
    $smarty->assign('confs', $res);
else
    //error処理

*/
