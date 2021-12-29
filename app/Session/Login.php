<?php

namespace App\Session;

class Login{

    /**
     * Método responsável por iniciar uma sessão
     *
     * @return void
     */
    public static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Método responsavel por logar o usuário
     *
     * @param Cliente $client
     * @return void
     */
    public static function login($client){
        //inicia a sessão
        self::init();

        //sessão do usuário
        $_SESSION['cliente'] = [
            "id" => $client->id,
            "nome" => $client->getNome(),
            "email" => $client->getEmail()
        ];

        //redireciona o usuário para o painel
        header('location: painel.php');
        exit;
    }

    /**
     * Método responsável por verificar se o usuário estar logado
     *
     * @return boolean
     */
    public static function isLogged(){
        //incia a sessão
        self::init();
        
        //Validação da sessão
        return isset($_SESSION['cliente']['id']);
    }

    /**
     * Método responsável por obrigar o usuário a tar logado para acessar
     *
     * @return void
     */
    public static function requireLogin(){
        //verifica se o usuário estar logado
        if(!self::isLogged()){
            header('location: index.php');
            exit;
        }
    }

    /**
     * Método responsável por retornar os dados do usuário logado
     *
     * @return void
     */
    public static function getUserLogado(){
        //inicia a sessão
        self::init();

        //retorna os dados da sessão do usuário
        return self::isLogged() ? $_SESSION['cliente'] : null;
    }

    /**
     * Método responsável por deslogar e encerrar a sessão
     *
     * @return void
     */
    public static function logout(){
        self::init();

        unset($_SESSION['cliente']);

        header('location: index.php');
        exit;
    }
}