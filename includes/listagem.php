<?php  
    // TRATA MENSAGEM DE SUCESSO OU ERRO
    $mensagem = '';
    if(isset($_GET['status'])){
    switch ($_GET['status']) {
        case 'sucess':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

        case 'error':
        $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
    }

    // GERA A LISTA NA TABELA
    $resultados = '';
    foreach($vagas as $vaga){
        $resultados .= '<tr>
                            <td>'.$vaga->id.'</td>
                            <td>'.$vaga->titulo.'</td>
                            <td>'.$vaga->descricao.'</td>
                            <td>'.($vaga->ativo == '1' ? 'ATIVO' : 'INATIVO').'</td>
                            <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$vaga->id.'" class="btn btn-warning">Editar</a> 
                                <a href="excluir.php?id='.$vaga->id.'" class="btn btn-danger" >Excluir</a>
                            </td>
                        </tr>';          
    }

    // CASO NÃO TENHA VAGAS NA LISTA
    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nenhuma vaga encontrada
                                                       </td>
                                                    </tr>';
?>

<main>

<div class="container">
    <?=$mensagem //EXIBE MENSAGEM DE ALERT?> 

    <h3>Listagem de vaga</h3>

    <a href="cadastrar.php" class="btn btn-primary"> Cadastrar </a> 
    <br /><br />
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descricao</th>
                <th scope="col">Status</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?=$resultados?>
        </tbody>
    </table>
</div>

</main>