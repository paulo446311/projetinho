<?php
require_once "php.php"; // conexão com o banco

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validação simples de senha
    if ($_POST["senha"] !== $_POST["confirmar-senha"]) {
        die("As senhas não coincidem!");
    }

    // Protege contra SQL Injection
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // senha criptografada
    $data_nascimento = mysqli_real_escape_string($conn, $_POST["data_nascimento"]);
    $curso = mysqli_real_escape_string($conn, $_POST["curso"]);

    // SQL para inserir os dados
    $sql = "INSERT INTO usuarios_login (nome_completo, email, senha_hash, data_nascimento, curso) 
            VALUES ('$nome', '$email', '$senha', '$data_nascimento', '$curso')";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Cadastro realizado com sucesso!</h2>";
        echo "<p><a href='criarconta.html'>Voltar para o cadastro</a></p>";
        // Opcional: redirecionar automaticamente
        // header("Location: criarconta.html");
        // exit();
    } else {
        echo "<h2>Erro ao cadastrar:</h2><p>" . mysqli_error($conn) . "</p>";
    }

    // Fecha a conexão somente aqui
    mysqli_close($conn);

} else {
    echo "Acesso inválido!";
}
?>
