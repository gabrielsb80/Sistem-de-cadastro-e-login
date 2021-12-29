<?php

namespace App\Entity;

use App\Db\Database;


class Cliente{
    /**
   * Identificador único do cliente
   * @var integer
   */
    public $id;
    /**
     * Nome do cliente
     *
     * @var string
     */
    private $nome;
    /**
     * e-mail do cliente
     *
     * @var string
     */
    private $email;
    /**
     * senha do cliente
     *
     * @var string
     */
    private $senha;
    private $data;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }


    /**
   * Método responsável por cadastrar um novo cliente no banco de dados
   * @return boolean
   */
    public function cadastrar(){
        date_default_timezone_set('America/Sao_Paulo');
        
        $this->data = date('Y-m-d');

        $obDatabase = new Database('clientes');

        $this->id = $obDatabase->insert([
                                        "nome" => $this->nome,
                                        "email" => $this->email,
                                        "senha" => $this->senha,
                                        "data" => $this->data

        ]);

        return true;
        

    }

    /**
   * Método responsável por atualizar a vaga no banco
   * @return boolean
   */
    public function atualizar($id){
        return (new Database('clientes'))->update('id = '.$id,'nome = "'.$this->nome.'"','email = "'.$this->email.'"');
                                                            
                                                            
        
    }

    /**
   * Método responsável por excluir a vaga do banco
   * @return boolean
   */
    public function excluir(){
        return (new Database('clientes'))->delete('id= '.$this->id);
    }

   
    /**
     * Método responsável por validar o email
     *
     * @param string $email
     * @return array
     */
    public static function ValidarEmail($email){
        return (new Database("clientes"))->select('email= "'.$email.'"')->fetchObject(self::class);
       
    }

    /**
   * Método responsável por buscar um cliente com base em seu ID
   * @param  integer $id
   * @return Cliente
   */
    public static function getCliente($id){
        return(new Database("clientes"))->select('id= '.$id)->fetchObject(self::class);
    }
}