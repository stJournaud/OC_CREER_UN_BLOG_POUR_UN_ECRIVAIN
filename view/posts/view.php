<?php $title_for_layout = $post->title; ?>
<img class="postImg" src="<?php echo Router::webroot('img/'.$post->image_name);?>" alt="">
<h1><?= $post->title; ?></h1>
<?= $post->content; ?>

<h2>Ajouter un commentaire</h2>
<form action="<?php echo Router::url('posts/addComment/'.$post->id.'/'.$post->slug); ?>" method="post">
<?php echo $this->Form->input('author', 'Auteur'); ?>
<?php echo $this->Form->input('content', 'Contenu', array('type' => 'textarea', 'class'=>'form-control '.(($error = null)?'is-invalid':'').'', 'rows' =>5, 'cols' =>10)); ?>
<div class="actions">
    <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form>

<h2>Commentaires</h2>
<?php foreach ($comments as $k=>$v): ?>
<div class="card comment-card">
  <div class="card-header">
    <h5><?php echo $v->author ?></h5>
    <a class="btn btn-outline-danger" href="<?php echo Router::url('posts/report/'.$v->id.'/'.$post->slug.'/'.$post->id); ?>">Signaler <i class="far fa-flag"></i></a>
  <h6 class="card-subtitle mb-2 text-muted">Le <?php echo date('d-m-Y',strtotime($v->comment_date)); ?></h6>
  </div>
  <div class="card-body">
    <?php echo $v->content ?>
</div>
</div>
<?php endforeach ?>