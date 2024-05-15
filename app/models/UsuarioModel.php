<?php

namespace App\models;

use App\Banco;

class UsuarioModel {

    // private $conn;

    public function getDados(){
        $pdo = Banco::conectar();
        $select = 'SELECT * FROM users'; // Substitua 'usuarios' pelo nome da tabela correta
        $dados = $pdo->query($select)->fetchAll(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $dados;
    }

    public function __construct() {
    }

    public function createUser($nome, $email, $senha) {
        $pdo = Banco::conectar();
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $dados = $stmt->execute([$nome, $email, $senha_hash]);
        Banco::desconectar();
        return $dados;
    }

    public function getUserByEmail($email) {
        $pdo = Banco::conectar();
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $dados;
    }
}
?>
