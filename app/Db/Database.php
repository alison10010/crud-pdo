<?php

    namespace App\Db;

    use \PDO;
    use \PDOException;

    class Database{
        const HOST = 'localhost'; // CONEXAO COM O BD
        const NAME = 'emprego_vagas'; // NOME DO BD
        const USER = 'root'; // NOME DO USUARIO
        const SENHA = ''; // SENHA DE ACESSO AO BD

        private $table; // TABELA SENDO MANIPULADA
        private $connection; // INSTANCIA DE CONEXAO COM BD

        // DEFINE A TABELA E INSTANCIA A CONEXAO
        public function __construct($table = null){
            $this->table = $table;    
            $this-> setConnection();
        }

        // CRIA CONEXAO COM O BD
        private function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER,self::SENHA);
                $this-> connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        // EXECUTA AS QUERYS DENTRO DO BD
        public function execute($query, $params = []){
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        // SALVA DADOS NO BD
        public function insert($values){
            // DADOS DA QUERY
            $fields = array_keys($values); // PEGA OS NOMES DOS ATRIBUTOS
            $binds = array_pad([],count($fields),'?'); // CONTA N° DE ATRIBUDOS E ATRIBUI NO VALUS

            // MONTA QUERY
            $query = 'INSERT INTO '.$this->table.' ('.implode(', ',$fields).') VALUES ('.implode(', ',$binds).')';

            // EXECUTA O INSERT
            $this->execute($query, array_values($values));

            // RETORNA O ID INSERIDO
            return $this->connection->lastInsertId();
        }

        // Executa consulta no BD
        public function select($where = null, $order = null, $limit = null){
            // DADOS DA QUERY SE TIVER CONDIÇÃO NA BUSCA
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';

            // MONTA QUERY
            $query = 'SELECT * FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            return $this->execute($query);
        }

        // ATUALIZA OS DADOS NO BD
        public function update($where,$values){
             // DADOS DA QUERY
             $fields = array_keys($values);
            
            // MONTA QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('= ?, ',$fields).' = ? WHERE '.$where;

            // EXECUTA O INSERT
            $this->execute($query, array_values($values));

            return true;
        }

        // EXCLUI DADOS DO BD
        public function delete($where){
            // MONTA QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            // EXECUTA O DELETE
            $this->execute($query);

            return true;
        }
    }