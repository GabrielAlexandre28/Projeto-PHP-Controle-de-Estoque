<?php
// db_connection.php

// Declaração das variáveis de configuração para a conexão com o banco de dados
$servername = "localhost"; // O nome do servidor do banco de dados, geralmente "localhost" para servidores locais
$username = "root"; // O nome de usuário para acessar o banco de dados, "root" é o padrão para servidores locais
$password = ""; // A senha correspondente ao usuário, geralmente em branco para servidores locais padrão
$dbname = "estoque"; // O nome do banco de dados que você deseja conectar

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);
// A função `new mysqli` cria uma nova conexão com o banco de dados usando os parâmetros fornecidos
// $conn é uma variável que irá armazenar a conexão com o banco de dados

// Checar conexão
if ($conn->connect_error) {
    // Verifica se ocorreu algum erro ao tentar conectar ao banco de dados
    // A propriedade `connect_error` da instância `$conn` contém a mensagem de erro, se houver
    die("Conexão falhou: " . $conn->connect_error);
    // Se houver um erro na conexão, o script é interrompido (usando `die`) e uma mensagem de erro é exibida
}

// Se a conexão foi bem-sucedida, o script continuará a ser executado normalmente
// O objeto de conexão `$conn` é retornado, permitindo que seja usado para interagir com o banco de dados em outros scripts PHP
return $conn;
?>