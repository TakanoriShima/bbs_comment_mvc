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
        <title>新規投稿</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">新規投稿</h1>
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
                <form class="col-sm-12" action="store.php" method="POST" enctype="multipart/form-data">
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">名前</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">タイトル</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">内容</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="body">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">画像アップロード</label>
                        <div class="col-sm-2">
                            <input type="file" name="image" accept='image/*' onchange="previewImage(this);">
                        </div>
                        <canvas id="canvas" class="offset-sm-4 col-4" width="0" height="0"></canvas>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">削除パスワード</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    
                    <!-- 1行 -->
                    <div class="form-group row">
                       <button type="submit" class="offset-sm-2 col-sm-10 btn btn-danger " id="upload">投稿</button>
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