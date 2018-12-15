<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN>

<?php
session_start();
require_once("conf/config.php");
echo "<html>";
$head = <<<EOH
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="home" content="このページはトップページです">
<meta name="keyword" content="掲示板, MySQL, PHP">
<title>おすそわけ錬金術</title>
<link rel="stylesheet" href="./menu.css" type="text/css">
</head>
EOH;
echo $head;
echo "<body>";



// ロゴ
echo "<div class='logo'><a href='menu.php'>";
echo "<img src='images/logo_over.png'　 width='500px' height='200px'　>";

echo "</a></div>";

// ログイン/ログアウト
echo "<div class='door'><form method='POST' action='auth.php'>";
if (empty($_SESSION["login"])) {
  echo "<input type='image' src='images/login.png'  width='80px' height='80px' >";
  echo "<input type='hidden' name='h' value='login'>";
} else {
  echo $_SESSION["login"]." さん こんにちは";
  echo "<input type='image' src='images/logout.png'  width='80px' height='80px'>";
  echo "<input type='hidden' name='h' value='logout'>";
}
echo "</form></div>";

try {
  // DB接続
  $s = new PDO("mysql:host=".$SERV.";dbname=".$DBNM.";charset=utf8", $USER, $PASS);
  // ページ分岐用変数
  $page = $_POST["h"];
  // ページ分岐
  switch("$page") {
  case "insert":   // メニュー登録フォームページ
    echo "<p><form method='post' action='menu.php'>";
    echo "<table class='reg'>";
    echo "<tr><td>メニュー名</td><td><input type='text' name='menu_name'></td></tr>";
    echo "<tr><td>材料</td><td><input type='text' name='menu_ing'></td></tr>";
    echo "<tr><td>量(何人前)</td><td><input type='text' name='menu_amount'></td></tr>";
    echo "<tr><td>画像</td><td><input type='file' name='menu_image'></td></tr>";
    echo "</table>";
    echo "<input type='submit' name='menu_insert' value='登録'>";
    echo "<input type='hidden' name='h' value='DBinsert'>";
    echo "</form></p>";
    break;
  case "DBinsert": // メニュー登録完了ページ
    $get_id = $s->query("select id from menu order by id desc limit 1");
    $lately_id = $get_id->fetch();
    $ins_id = $lately_id["id"]+1;
    $ins_name = $_POST["menu_name"];
    $ins_ing = $_POST["menu_ing"];
    $ins_amount = $_POST["menu_amount"];
    $ins_author = $_SESSION["login"];
    $ins_image = $_POST["menu_image"];
    $ins_date = date("Y-m-d H:i:s");
    $re = $s->query("insert into menu(id, name, ing, amount, author, image, date) values($ins_id, '$ins_name', '$ins_ing', $ins_amount, '$ins_author', '$ins_image', '$ins_date')");
    echo "<p>メニューを登録しました</p>";
    break;
  case "delete":   // メニュー削除ページ
    break;
  case "DBdelete": //メニュー削除完了ページ
    $del_id = $_POST["menu_id"];
    if (preg_match("/^[0-9]+$/", $del_id)) {
      $s->query("delete from osusowake where id=$del_id");
    }
    $re = $s->query("select * from osusowake order by menu_id");
    break;
  case "search": //メニュー検索ページ
    break;
  case "DBsearch": // メニュー検索完了ページ
    break;
  default:         // メニュー表示ページ
    if (isset($_SESSION["login"])) {
      echo "<p><form method='POST' action='menu.php'>";
      echo "<div class='insert'><input type='submit' value='おすそわけ' align='right'></div>";
      echo "<input type='hidden' name='h' value='insert'>";
      echo "</form></p>";
    }
    $re = $s->query("select id from menu");
    $ids = $re->fetchAll();
    for ($i = 0; $i < count($ids); $i++) {
      $sid = $ids[$i]["id"];
      $re = $s->query("select * from menu where id=$sid");
      $menus = $re->fetch();
      $name = $menus["name"];
      $ing = $menus["ing"];
      $amount = $menus["amount"];
      $author = $menus["author"];
      $image = $menus["image"];
      $enc_image = base64_encode($image);
      $date = $menus["date"];
      echo "<p class='menu'><table>";
      echo "<tr><th class='name'>$name</th></tr>";
      echo "<tr><td><img src='data:image/png;base64', $enc_image></td></tr>";
      echo "<tr><td>材料$ing</td></tr>";
      echo "<tr><td>$amount 人分</td><tr>";
      echo "<tr><td>作成者 $author</td></tr>";
      echo "<tr><td>作成日時 $date</td><tr>";
      if (isset($_SESSION["login"]) and $author == $_SESSION["login"]) {
        echo "<tr><td><form method='POST' actiron='menu.php'>";
        echo "<input type='submit' value='削除' class='delete'>";
        echo "<input type='hidden' name='h' value='delete'>";
        
        echo "<div class='track'><a href='dammy.html'>";
echo "<img src='images/link_track.png' width='200px' height='200px'>";
echo "</a></div>";
        
        echo "</form></td></tr>";
      }
      echo "</table></p>";
    }
    echo "<p><form method='POST' action='menu.php'>";
    echo "<input type='hidden' name='h' value='search'>";
    echo "</form></p>";
    //echo "</div>";
    break;
  }
} catch(Exception $e) {
  var_dump($e);  
}

// クリスマス仕様
echo "<section id='snow'>";
echo "<div class='inner'>";
echo "<div class='flake1'></div>";
echo "<div class='flake2'></div>";
echo "<div class='flake3'></div>";
echo "<div class='flake4'></div>";
echo "<div class='flake5'></div>";
echo "<div class='flake6'></div>";
echo "<div class='flake7'></div>";
echo "<div class='flake8'></div>";
echo "</div>";
echo "<div class='inner2'>";
echo "<div class='flake9'></div>";
echo "<div class='flake10'></div>";
echo "<div class='flake11'></div>";
echo "<div class='flake12'></div>";
echo "</div>";
echo "</section>";

echo "</body>";
echo "</html>";
?>
