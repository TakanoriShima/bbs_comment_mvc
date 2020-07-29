<?php
    // テストプログラム
    $dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_5774074b0e1fbed';
    $username = 'be98aadb1041f4';
    $password = 'dd672692';
    $messages = array();
    // $dsn = 'mysql:host=localhost;dbname=bbs';
    // $username = 'root';
    // $password = '';
    // $messages = array();

    try {
    
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
        ); 
        
        $pdo = new PDO($dsn, $username, $password, $options);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        // PDO::fetch()でカレント1件を取得
        $stmt = $pdo->query('SELECT * FROM messages order by id desc');
        // $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    
        $messages = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'PDO exception: ' . $e->getMessage();
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <title>簡易掲示板</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class=" col-sm-12 text-center">投稿一覧</h1>
            </div>
            <div class="row mt-2">
                <table class="col-sm-12 table table-bordered table-sprited">
                    <tr>
                        <th>ID</th>
                        <th>ユーザ名</th>
                        <th>タイトル</th>
                        <th>内容</th>
                        <th>投稿時間</th>
                    </tr>
                    </tr>
                <?php foreach($messages as $message){ ?>
                    <tr>
                        <td><a href="show.php?id=<?php print $message['id']; ?>"><?php print $message['id']; ?></a></td>
                        <td><?php print $message['name']; ?></td>
                        <td><?php print $message['title']; ?></td>
                        <td><?php print $message['body']; ?></td>
                        <td><?php print $message['created_at']; ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <div class="row mt-5">
                <a href="new.php" class="btn btn-primary">新規投稿</a>
            </div> 
        </div>
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>