<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar vaga');

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
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
    $obVaga->atualizar();  

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formularioEdit.php';
include __DIR__.'/includes/footer.php';

?>