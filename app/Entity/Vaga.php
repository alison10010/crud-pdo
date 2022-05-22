<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{
    
    public $id; // IDENTIFICADOR DA VAGA
    public $titulo; // TITULO DA VAGA
    public $descricao; // DESCRICAO DA VAGA
    public $status; // STATUS DA VAGA (1)ATIVO OU (0)INATIVO
    public $data; // DATA DE PUBLICACAO DA VAGA

    // METODO RESPONSAVEL PARA CADASTRAR NOVA VAGA NO BANCO
    public function cadastrar(){
        // DEFINE A DATA DE CADASTRO DA VAGA
        $this->data = date('Y-m-d H:i:s');      

        // INSERIR A VAGA NO BANCO
        $obDataBase = new Database('vagas'); // NOME DA TABELA NO BD
        $this->id =  $obDataBase->insert([
                        'titulo' => $this->titulo,
                        'descricao' => $this->descricao,
                        'ativo' => $this->ativo,
                        'data' => $this->data
                    ]);

        //echo "<pre>";print_r($this); echo "</pre>"; exit; 
        // RETORNA SUCESSO
        return true;
    }

    // ATUALIZA A VAGA NO BD
    public function atualizar(){
        return (new Database('vagas'))->update('id = '.$this->id,[
                        'titulo' => $this->titulo,
                        'descricao' => $this->descricao,
                        'ativo' => $this->ativo,
                        'data' => $this->data
        ]);
    }

    // EXCLUI UMA UNICA VAGA DE ACORDO COM SEU ID
    public function excluir(){
        return (new Database('vagas'))->delete('id = '.$this->id);
    }

    // OBTEM A LISTA DE VAGAS DO BD
    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // BUSCA UMA UNICA VAGA DE ACORDO COM SEU ID PARA EDICAO
    public static function getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)
                                      ->fetchObject(self::class);
    }

}