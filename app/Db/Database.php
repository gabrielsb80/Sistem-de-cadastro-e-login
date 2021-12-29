<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{
    /**
   * Host de conexão com o banco de dados
   * @var string
   */
    const HOST = "localhost";

    /**
   * Nome do banco de dados
   * @var string
   */
    const NAME = "cliente";

    /**
   * Usuário do banco
   * @var string
   */
    const USER = "root";

  /**
   * Senha de acesso ao banco de dados
   * @var string
   */
    const PASSWORD = "";

    /**
   * Nome da tabela a ser manipulada
   * @var string
   */
    private $table;

    /**
   * Instancia de conexão com o banco de dados
   * @var PDO
   */
    private $connection;

     /**
   * Define a tabela e instancia e conexão
   * @param string $table
   */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
   * Método responsável por criar uma conexão com o banco de dados
   */
    public function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("ERROR: ".$e->getMessage());
        }
    }

    /**
   * Método responsável por executar queries dentro do banco de dados
   * @param  string $query
   * @param  array  $params
   * @return PDOStatement
   */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die("ERROR: ".$e->getMessage());
        }

        
    }

     /**
   * Método responsável por inserir dados no banco
   * @param  array $values [ field => value ]
   * @return integer ID inserido
   */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($values),'?');
        
        //MONTA A QUERY
        $query = 'INSERT INTO ' .$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        //EXECUTA O INSERT
        $this->execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();

        

    }

    /**
     * Método responsável por executar uma consulta no banco
     *
     * @param string $where
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where,$fields = '*'){
        //MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' WHERE '.$where;
        //EXECUTA A QUERY
        return $this->execute($query);
        

        
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     *
     * @param string $where
     * @param string $value1
     * @param string $value2
     * @return void
     */
    public function update($where, $value1,$value2){
        //MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.$value1.','.$value2.' WHERE '.$where;
        //EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por excluir dados do banco
     *
     * @param string $where
     * @return boolean
     */
    public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }

   
}