<!DOCTYPE html>
<html lang="pt-br">

<?php include(VIEWS_PATH . "/template/head.php"); ?>

<body>

    <h1><?= $titulo?></h1>

    <a href="noticias/register">Cadastrar nova Notícia</a>

    <ul>
        <?php foreach ($noticias as $n) { ?>
            <li><a href="noticias/edit/<?= $n['id'] ?>">Editar</a> <a href="noticias/delete/<?= $n['id'] ?>">Excluir</a> <a href="noticias/<?= $n['id'] ?>"><?= $n['titulo'] ?></a></li>
        <?php } ?>
    </ul>

</body>

</html>