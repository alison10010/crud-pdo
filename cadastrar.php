<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar vaga');

// CHAMA A ENTIDADE VAGA
use \App\Entity\Vaga;
$obVaga = new Vaga;

// VERIFICA OS DADOS DO FORM
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
    $obVaga->cadastrar();  

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';

?>