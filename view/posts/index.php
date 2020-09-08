<?php foreach ($posts as $k => $v): ?>
        <div class="card card-resume text-dark bg-light mb-3">
          <div class="card-header bg-transparent">
            <h2><?php echo $v->title; ?></h2>
            <p>Le <?php echo date('d-m-Y',strtotime($v->creationDate)); ?></p>
          </div>
          <div class="card-body">
          <?php echo $v->content; ?>
          </div>
          <div class="card-footer bg-transparent">
          <h5><a class="btn btn-outline-dark" href="<?php echo Router::url("posts/view/id:{$v->id}/slug:{$v->slug}"); ?>">Lire la suite <i class="fas fa-arrow-right"></i></a></h5>
          </div>
        </div>
        
<?php endforeach ?>

<nav aria-label="post-pagination">
  <ul class="pagination">
      <?php for($i = 1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="page-item active"'; ?>class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php endfor; ?>
  </ul>
</nav>