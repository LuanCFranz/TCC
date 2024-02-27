<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost:3306", "root", "Lu@n1105", "tcc");

    $ativar_js = true;

    // Teste de conexão
    if (!$conexao) {
        echo "Falha na conexão com o banco de dados.";
    } else {
        // Recupera os dados do formulário e valida
        $cpf = isset($_POST['cpf']) ? mysqli_real_escape_string($conexao, $_POST['cpf']) : '';
        $nome = isset($_POST['nome']) ? mysqli_real_escape_string($conexao, $_POST['nome']) : '';
        $dataNasc = isset($_POST['data_nasc']) ? mysqli_real_escape_string($conexao, $_POST['data_nasc']) : '';
        $endereco = isset($_POST['endereco']) ? mysqli_real_escape_string($conexao, $_POST['endereco']) : '';
        $telefone = isset($_POST['telefone']) ? mysqli_real_escape_string($conexao, $_POST['telefone']) : '';
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, $_POST['email']) : '';
        $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, $_POST['senha']) : '';

        // Verifica se o CPF já está cadastrado
        $sql = "SELECT cpf FROM pessoa_fisica WHERE cpf='$cpf'";
        $retorno = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($retorno,) > 0) {
            echo "<script>window.location.href='http://localhost/Inova%20Start/Inova%20Start/CadastroInvestidor/cadastro_in.html';</script>";
        echo "aviso";
        } else {
            // Insere os dados no banco de dados
            $sql = "INSERT INTO pessoa_fisica(nome, cpf, data_nasc, endereco, telefone, email, senha) VALUES ('$nome', '$cpf', '$dataNasc', '$endereco', '$telefone', '$email', '$senha')";
            if (mysqli_query($conexao, $sql)) {
                
                // Redireciona o navegador para a página especificada usando JavaScript
                echo "<script>window.location.href='http://localhost/Inova%20Start/Inova%20Start/Login/login.html';</script>";
                
            } else {
                echo "Erro ao cadastrar: " . mysqli_error($conexao);
            }
        }
    }
} else {
    echo "Formulário não submetido.";


}



?>

