<?php

namespace App\controllers;

use App\Banco;
use App\models\UsuarioModel;
use App\Route;

class IndexController
{
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $usuariosModel = new UsuarioModel();
            $result = $usuariosModel->createUser($nome, $email, $senha);

            if ($result) {
                echo '<script>window.location.href = "/";
                alert("Usuário cadastrado com sucesso!");</script>';
            exit();   
            } else {
                echo '<script>alert("Erro ao cadastrar usuário.");</script>';
            }
        }
        require_once '..\app\views\cadastro.phtml'; 
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $usuariosModel = new UsuarioModel();
           $result= $usuariosModel->getUserByEmail($email);
           if ($result) {
            header("Location: /");
            exit();   
             
        } else {
                echo'<script>alert("Usuário ou senha incorretos.");</script>';
            }
        }
        require_once '..\app\views\login.phtml'; 
}
    public function index()
    {
        // Estabelece a conexão com o banco de dados
        $conn = Banco::conectar();
    
        // Lógica para carregar a página inicial
        $usuariosModel = new UsuarioModel($conn); // Passando a conexão como argumento
        $dados = $usuariosModel->getDados();
        require_once '..\app\views\indexInicial.phtml';
    
        // Não esqueça de desconectar após o uso, se necessário
        Banco::desconectar($conn);
    }
    public function explorar()
    {
        require_once '..\app\views\explorar.phtml';
    }

    public function ingressos()
    {
        require_once '..\app\views\ingressos.phtml';
    }
}
?>