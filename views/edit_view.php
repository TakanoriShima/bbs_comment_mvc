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
        <title>投稿の更新</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-2">
                <h1 class="text-center col-sm-12 mt-2">id: <?= $message->id ?> の投稿の更新</h1>
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
                <form class="col-sm-12" action="update.php?id=<?= $message->id ?>" method="POST" enctype="multipart/form-data">
               
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">名前</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" value="<?= $message->name ?>">
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">タイトル</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="title" value="<?= $message->title ?>";>
                        </div>
                    </div>
                    
                    <!-- 1行 -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">内容</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="body" value="<?= $message->body ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-2 col-form-label">現在の画像</label>
                        <div class="col-10">
                            
                            <img src="<?php if(file_exists(IMAGE_DIR . $message->image)){ print IMAGE_DIR . $message->image; }else{ print 'no-image.png';} ?>" alt="表示する画像がありません。">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-2 col-form-label">画像アップロード</label>
                        <div class="col-2">
                            <input type="file" name="image" accept='image/*' onchange="previewImage(this);">
                        </div>
                        <canvas id="canvas" class="offset-sm-4 col-2" width="0" height="0"></canvas>
                    </div>
                    
                    
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $message->id; ?>">
                    </div>
                    
                    <div class="row">
                        <label class="form-group col-2 col-form-label">更新パスワード</label>
                        <div class="col-10">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                
                    <!-- 1行 -->
                    <div class="form-group row mt-3">
                        <div class="offset-sm-4 col-sm-4">
                            <button type="submit" name="kind_method" value="update" class="form-control btn btn-primary">更新</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-5">
                <a href="show.php?id=<?= $id ?>" class="btn btn-primary">投稿詳細へ</a>
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