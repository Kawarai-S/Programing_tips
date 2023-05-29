<?php
// データを取得
$s_keyword = isset($_GET['s_keyword']) ? $_GET['s_keyword'] : '';
$s_topics = isset($_GET['s_topic']) ? $_GET['s_topic'] : array();
// $s_keyword = $_GET['s_keyword'];
// $s_topics = $_GET['s_topic'];

// DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db02;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

// 検索条件
$sql = "SELECT * FROM tips_table WHERE";
$search_words = array();


if(!empty($s_keyword)){
    $search_words[] = " text LIKE '%$s_keyword%'";
}

if(!empty($s_topics)){
    $search_topics = array();
    foreach ($s_topics as $topic){
        $search_topics[] = " topic LIKE '%$topic%'";
    }
    $search_words[]="(".implode(" OR",$search_topics).")";
}

if (empty($search_words)) {
    die("検索条件を指定してください");
}

$sql .= implode(" AND",$search_words);

//データを検索
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//検索結果の取得
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 検索結果の表示
$rowCount = count($result);
$view="";
if ($rowCount > 0) {
    foreach ($result as $row) {
        $view .= "<table/>";
        $view .= "<tr><td>トピック</td><td> " . $row["topic"] . "</td></tr>";
        $view .= '<tr><td>URL</td><td><a href="' . $row["url"] . '">'. $row["url"].'</a></td></tr>';
        $view .= "<tr><td>説明</td><td>" . $row["text"] . "</td></tr>";
        $view .= "</table>";
    }
} else {
    $view .= "該当する結果はありません";
}

// echo $view
?>