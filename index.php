<?php
// 変数を定義（null合体演算子を利用）
$s_keyword = $_GET['s_keyword'] ?? ''; //$_GET['s_keyword']が存在しないか、値がnullの場合に、空の文字列 '' を代入する
$s_topics = $_GET['s_topic'] ?? [];

// DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db02;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

//表示ようの変数を定義
$view="";

// 検索フォームが送信された場合の処理
if (isset($_GET['s_keyword']) || isset($_GET['s_topic'])) {
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
    if ($rowCount > 0) {
        foreach ($result as $row) {
            $view .= '<div class="center">';
            $view .= '<table class="table"/>';
            $view .= '<tr><td class="midasi">トピック</td><td>' . $row["topic"] . '</td></tr>';
            $view .= '<tr><td class="midasi">URL</td><td><a href="' . $row["url"] . '">'. $row["url"].'</a></td></tr>';
            $view .= '<tr><td class="midasi">説明</td><td>' . $row["text"] . '</td></tr>';
            $view .= '</table>';
            $view .= '</div>';
        }
    } else {
        $view .= "該当する結果はありません";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrap">
        <div class="title">
            <h2>Programing tips</h2>
        </div>
        <div class="add">
            <a href=" tips_add.php"><p><i class="fa-solid fa-pen-to-square"></i> 新しいtipsを入力する</p></a>
        </div>
        <div class="center">    
            <form action="index.php" method="GET">
            <div class="form">
                <label for="s_keyword"><i class="fa-solid fa-key"></i> キーワード</label><br>
                <input class="text_box" type="text" name="s_keyword">
            </div>
            <div class="form">
                <label for="s_topic"><i class="fa-solid fa-square-check"></i> カテゴリ</label><br>
                <input type="checkbox" name="s_topic[]" value="HTML">HTML
                <input type="checkbox" name="s_topic[]" value="CSS">CSS
                <input type="checkbox" name="s_topic[]" value="JavaScript">JavaScript
                <input type="checkbox" name="s_topic[]" value="PHP">PHP
                <input type="checkbox" name="s_topic[]" value="Laravel">Laravel
                <input type="checkbox" name="s_topic[]" value="other">その他

            </div>
            <div class="center">
                <input class="button" type="submit" value="検索">
            </div>
            </form>
        </div>
        <div>
            <!-- 検索結果の表示 -->
            <?=$view?>
        </div>
    </div>
</body>
</html>