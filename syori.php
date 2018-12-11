<?php
require_once("conf/config.php");
echo "<html>";
$head = <<<EOH
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="home" content="このページはDB処理用ページです">
<meta name="keyword" content="掲示板, MySQL, PHP">
<title>おすそわけ錬金樹</title>
<link rel="stylesheet" href="./menu.css" type="text/css">
</head>
EOH;
echo $head;
echo "<body>";
echo "<p><h1>おすそわけ錬金樹</h1></p>";
try{
  /*** DB接続 ***/
  $s = new PDO("mysql:host=".$SERV.";dbname=".$DBNM.";charset=utf8", $USER, $PASS);
  /*** nameがhのvalueを変数$h_dに代入 ***/
  $h_d = $_POST["h"];
  /*** $h_dがsel, ins, del, serのどれかで条件分岐 ***/
  switch("$h_d"){
    case "sel":
      $re = $s->query("select * from tbk order by bang");
      break;
    case "ins":
      $ins_id = $_POST["id"];
      $ins_name = $_POST["name"];
      $ins_ing = $_POST["ing"];
      $ins_amount = $_POST["amount"];
      $ins_author = $_POST["author"];
      $ins_image = $_POST["image"];
      $ins_data = $_POST["data"];
      $s->query("insert into osusowake(id, name, ing, amount, author, image, data) values('$ins_id', '$ins_name', "$ins_ing", "ins_amount", "ins_author", "ins_image", "ins_data")");
      $re = $s->query("select * from osusowake order by id");
      break;
    case "del":
      $del_id = $_POST["id"];
      if(preg_match("/^[0-9]+$/", $del_id)){
        $s->query("delete from osusowake where id=$del_id");
      }
      $re = $s->query("select * from osusowake order by id");
      break;
    case "ser":
      $c1_d = $_POST["c1"];
      $c2_d = $_POST["c2"];
      $words = preg_split('/[\s]+/', mb_convert_kana($c1_d, 's', 'UTF-8'));
      $query = "select * from tbk where (nama like '%$words[0]%' or  mess like '%$words[0]%') ";
      for($i = 1; $i < count($words); $i++){
        if($c2_d == 'and'){
          $query .= "and ";
        }
        else{
          $query .= "or ";
        }
        $query .= "(nama like '%$words[$i]%' or  mess like '%$words[$i]%') ";
      }
      $query .= "order by bang";
      $re = $s->query($query);
      break;
    case "reb":
      $s->query("drop table if exists tbk");
      $s->query("create table tbk (bang INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(100), mess VARCHAR(100))");
      $re = $s->query("select * from tbk order by bang");
      break;
  }
  /*** queryの結果を表示 ***/
  echo "<table class='chat'>";
  while($kekka = $re->fetch()){
    echo "<tr><td class='num'>";
    echo htmlspecialchars($kekka[0]);
    echo "</td><td>";
    echo htmlspecialchars($kekka[1]);
    echo "</td><td>";
    echo "<div class='balloon'><p>";
    echo htmlspecialchars($kekka[2]);
    echo "</p></div>";
    echo "</td></tr>";
  }
  echo "</table>";
  /*** トップページへのリンク ***/
  echo "<br><a href='menu.php' class='btn_blue'>トップメニューに戻ります</a>";
}
catch(Exception $e){
  var_dump($e);
}
echo "</body>";
echo "</html>";
?>
