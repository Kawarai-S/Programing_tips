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
        <a href=" index.php"><p><i class="fa-solid fa-magnifying-glass"></i> 検索に戻る</p></a>
    </div>
        
    <div class="center">
        <form action="tips_insert.php" method="POST">
        <div class="form">
            <label for="topic"><i class="fa-solid fa-square-check"></i> カテゴリ</label><br>
            <input type="checkbox" name="topic[]" value="HTML">HTML
            <input type="checkbox" name="topic[]" value="CSS">CSS
            <input type="checkbox" name="topic[]" value="JavaScript">JavaScript
            <input type="checkbox" name="topic[]" value="PHP">PHP
            <input type="checkbox" name="topic[]" value="Laravel">Laravel
            <input type="checkbox" name="topic[]" value="other">その他
        </div>
        <div class="form">
            <label for="url"><i class="fa-solid fa-earth-americas"></i> サイトURL</label><br>
            <input class="text_box" type="text" name="url" required>
        </div>
        <div class="form">
            <label for="text"><i class="fa-regular fa-file-lines"></i> 説明</label><br>
            <textarea  class="text_box" name="text" required></textarea>
        </div>
        <div class="center">
            <input class="button" type="submit" value="保存">
        </div>
        </form>
    </div>
</div>

    
</body>
</html>