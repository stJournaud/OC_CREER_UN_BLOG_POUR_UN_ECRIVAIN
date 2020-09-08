<div class="page-header">
    <h1><?php echo $total; ?> Commentaires signalés</h1>
</div>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Article</th>
            <th scope="col">Auteur</th>
            <th scope="col">Contenu</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($comments as $k => $v): ?> 
        <tr>
            <td><?php echo $v->id; ?></td>
            <td><?php echo $v->id_post; ?></td>
            <td><?php echo $v->author; ?></td>
            <td><?php echo $v->content; ?></td>
            <td>
                <a class="btn btn-outline-primary" onclick="return confirm('Voulez vous changer ce commentaire en désirable ?');" href="<?php echo Router::url('admin/comments/desirable/'.$v->id); ?>">Désirable</a>
                <a class="btn btn-outline-danger" onclick="return confirm('Voulez vous vraiment supprimer ce commentaire ?');" href="<?php echo Router::url('admin/comments/delete/'.$v->id); ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

