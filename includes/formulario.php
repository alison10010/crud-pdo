<main>

<div class="container">

    <h3><?=TITLE?></h3>

    <form method="post">
        <div class="form-group">
            <label for="titulo">Titulo da vaga:</label>
            <input type="txt" class="form-control" id="titulo" name="titulo" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descricao da vaga:</label>
            <textarea type="txt" class="form-control" id="descricao" name="descricao" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <label class="radio-inline">
                <input type="radio" name="ativo" value="1" checked>Ativo
            </label>
            <label class="radio-inline">
                <input type="radio" name="ativo" value="0">Inativo 
            </label>
        </div>

        <a href="index.php" class="btn btn-danger"> cancelar </a>        
        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </form>

</div>

</main>
