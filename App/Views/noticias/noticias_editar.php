<!DOCTYPE html>
<html lang="pt-br">

<?php include(VIEWS_PATH . "/template/head.php"); ?>

<body>

    <h1><?= $titulo?></h1>

    <form action="<?= isset($noticia) ? 'noticias/update' : 'noticias' ?>" method="POST">
        <?php if (isset($noticia)) { ?>
            <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
        <?php } ?>

        <label>Título: </label> <br>
        <input type="text" name="titulo" value="<?= isset($noticia) ? $noticia['titulo'] : null ?>"><br><br>

        <label>Data: </label><br>
        <input type="date" name="data" value="<?= isset($noticia) ? $noticia['data'] : null ?>"><br><br>

        <label>Texto: </label><br>
        <textarea name="texto" rows="10"><?= isset($noticia) ? $noticia['texto'] : null ?></textarea><br><br>

        <button type="submit" >Salvar</button>

    </form>

</body>

</html>