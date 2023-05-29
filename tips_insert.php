<?php
//POSTデータを取得
$topic = $_POST['topic'];
$url = $_POST['url'];
$text = $_POST['text'];

//配列を文字列に変換
$topicStr = implode(', ', $topic);

// DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db02;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

//データ登録
$sql = "INSERT INTO tips_table(topic,url,text,indate)VALUES(:topicStr,:url,:text,sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':topicStr', $topicStr, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
  }else{
    //５．index.phpへリダイレクト
    header('Location: index.php');
    exit();
  
  }
?>