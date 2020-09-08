<!DOCTYPE html>
<html xmins="http://www.w3.org/199/xhtml" xml:lang="fr" lang="fr"></html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo isset($title_for_layout)?$title_for_layout:'JFS'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/Blog/webroot/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Taviraj&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/286a956a3b.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header>
    <img src="<?php echo Router::webroot('img/header/JFS.png');?>"alt="">
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo Router::url('posts/index');?>">
        <img src="<?php echo Router::webroot('img/header/JFSmini2.png');?>"alt="" width="40" height="40">
        </a>
                <ul class="navbar-nav">
                <?php $pagesMenu = $this->request('Pages', 'getMenu'); ?>
                <?php foreach($pagesMenu as $p): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL.'/pages/view/'.$p->id; ?>" title="<?php echo $p->title; ?>"> <?php echo $p->title; ?> </a>
                </li>
                <?php endforeach; ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo Router::url('posts/index');?>">Articles</a></li>
                </ul>
    </nav>

    <div class="container">
        <?php echo $this->Session->flash(); ?>
        <?php echo $content_for_layout; ?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script></html>
