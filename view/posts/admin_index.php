<div class="page-header">
    <h1><?php echo $total; ?> Articles</h1>
</div>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">En ligne</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $k => $v): ?> 
        <tr>
            <td><?php echo $v->id; ?></td>
            <td><span class="label <?php echo ($v->online==1)?'badge badge-success':'badge badge-secondary'; ?>"><?php echo ($v->online==1)?'En ligne':'Hors ligne'; ?></span></td>
            <td><?php echo $v->title; ?></td>
            <td>
                <a class="btn btn-outline-primary" href="<?php echo Router::url('admin/posts/edit/'.$v->id); ?>">Editer</a>
                <a class="btn btn-outline-danger" onclick="return confirm('Voulez vous vraiment supprimer ce contenu ?');" href="<?php echo Router::url('admin/posts/delete/'.$v->id); ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<a href="<?php echo Router::url('admin/posts/edit') ?>" class="btn btn-outline-dark">Ajouter un article</a>