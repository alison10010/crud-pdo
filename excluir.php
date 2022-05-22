<?php

require __DIR__.'/vendor/autoload.php';

// CHAMA A ENTIDADE VAGA
use \App\Entity\Vaga;

// VERIFICA SE POSSUI UM ID PARA EDIÇÃO
if(!isset($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

// CONSULTA A VAGA
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDACAO DA VAGA E DIRECIONA PARA O INDEX CASO NAO EXISTA O ID
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

//echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

// VERIFICA OS DADOS DO FORM
if(isset($_POST['excluir'])){

    $obVaga->excluir();  

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmarExclucao.php';
include __DIR__.'/includes/footer.php';

?>