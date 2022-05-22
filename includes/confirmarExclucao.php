<main>

<div class="container">

    <h3>Excluir vaga</h3>

    <form method="post">
        <div class="form-group">
            <p for="titulo">Você deseja realmente excluir a vaga <b><?=$obVaga->titulo?><b> ?</p>
        </div>
        <br />
        <a href="index.php" class="btn btn-primary"> cancelar </a>        
        <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>

    </form>

</div>

</main>
