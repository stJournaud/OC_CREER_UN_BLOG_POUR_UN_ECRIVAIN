<div class="page-header">
<h1>Editer un article</h1>
</div>

<form action="<?php echo Router::url('admin/posts/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
    <?php echo $this->Form->input('title', 'Titre'); ?>
    <?php echo $this->Form->input('slug', 'Url'); ?>
    <?php echo $this->Form->input('file', 'Image', array('type'=>'file')); ?>
    <?php echo $this->Form->input('id', 'hidden'); ?>
    <?php echo $this->Form->input('content', 'Contenu', array('type' => 'textarea', 'class'=>'form-control postEditor', 'rows' =>5, 'cols' =>10)); ?>
    <?php echo $this->Form->input('online', 'En ligne', array('type' => 'checkbox')); ?>
    <div class="actions">
    <input type="submit" class="btn btn-outline-primary" value="Envoyer">
    </div>

</form>