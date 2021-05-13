<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="images/favicon.ico">
        <title>投稿詳細</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">id: <?= $id ?> の投稿詳細</h1>
            </div>
            
            <?php if($flash_message !== null): ?>
            <div class="row mt-2">
                <h2 class="text-center col-sm-12"><?= $flash_message ?></h1>
            </div>
            <?php endif; ?>
            <?php if($errors !== null): ?>
            <div class="row">
                <ul class="offset-sm-4 col-sm-4">
                <?php foreach($errors as $error): ?>
                    <li class="text-danger text-center"><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <div class="row mt-2">
                <h4 class="text-center col-sm-12"><a href="edit.php?id=<?= $id ?>" class="btn btn-primary col-sm-12">更新ページへ</a></h4>
            </div>
            <div class="row mt-2">
                <form action="destroy.php" method="POST" class="col-sm-12">
                    <input type="hidden" name="id" value="<?= $message->id ?>">
                    <label class="form-group col-sm-2 col-form-label">削除パスワード</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control col-sm-12">
                    </div>
                    <button type="submit" class="form-control btn btn-danger col-sm-1 mt-2" onclick="return confirm('投稿を削除します。よろしいですか？')">削除</button>
                </form>
            </div>

            <div class="row mt-3">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">投稿者</th>
                        <td class="text-center"><?= $message->name ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">投稿日時</th>
                        <td class="text-center"><?= $message->created_at ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">タイトル</th>
                        <td class="text-center"><?= $message->title ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">内容</th>
                        <td class="text-center"><?= $message->body ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">画像</th>
                        <td class="text-center">
                            <img src="<?= IMAGE_DIR . $message-> image ?>">
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="row mt-2">
                <h3 class="text-center offset-sm-2 col-sm-8 mt-2">コメント一覧</h3>
            </div>
            <!--データが1件でもあれば-->
            <?php if(count($comments) !== 0): ?> 
            <div class="row mt-4">
                <p class="offset-sm-2 col-sm-8"><?= count($comments) ?>件</p>
            </div>
            <div class="row mt-2">
                <table class="offset-sm-2 col-sm-8 table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>ユーザ名</th>
                        <th>コメント</th>
                        <th>投稿時間</th>
                    </tr>
                    </tr>
                <?php foreach($comments as $comment): ?>
                    <tr>
                        <td><?= $comment->id ?></a></td>
                        <td><?= $comment->name ?></td>
                        <td><?= $comment->content ?></td>
                        <td><?= $message->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
             <div class="row mt-4">
                <p class="offset-sm-2 col-sm-8">コメントはまだありません。</p>
            </div>
            <?php endif; ?>

            <div class="row mt-2 comments">
                <form class="offset-sm-2 col-sm-8" action="comment_store.php" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="col-sm-4 col-form-label">名前</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" value="<?= "" ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-sm-6 col-form-label">コメント</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="content" value="<?= "" ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-3 mt-3">
                            <label class="col-sm-6 col-form-label"></label>
                            <div class="col-sm-12">
                                <button type="submit" class="form-control btn btn-primary">投稿</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $message->id ?>">
                    </div>
                </form>
            </div>
                   
             <div class="row mt-5">
                <a href="index.php" class="btn btn-primary">投稿一覧へ</a>
            </div>
            
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>