<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost:3306", "root", "Lu@n1105", "tcc");

    // Verifica se houve erro na conexão
    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Prepara os dados do formulário para inserção no banco de dados
    $nomeEmpresa = isset($_POST['nomeEmpresa']) ? mysqli_real_escape_string($conexao, $_POST['nomeEmpresa']) : '';
    $cnpj = isset($_POST['cnpj']) ? mysqli_real_escape_string($conexao, $_POST['cnpj']) : '';
    $telefonePJ = isset($_POST['telefonePJ']) ? mysqli_real_escape_string($conexao, $_POST['telefonePJ']) : '';
    $emailPJ = isset($_POST['emailPJ']) ? mysqli_real_escape_string($conexao, $_POST['emailPJ']) : '';
    $senhaPJ = isset($_POST['senhaPJ']) ? mysqli_real_escape_string($conexao, $_POST['senhaPJ']) : '';

    // Verifica se o CNPJ já está cadastrado
    $query_verificacao = "SELECT cnpj FROM pessoa_juridica WHERE cnpj='$cnpj'";
    $resultado_verificacao = mysqli_query($conexao, $query_verificacao);

    if (!$resultado_verificacao) {
        die("Erro ao executar consulta: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($resultado_verificacao) > 0) {
        echo "<script>window.location.href='http://localhost/Inova%20Start/Inova%20Start/CadastroInvestidor/cadastro_in.html';</script>";
        echo "aviso";
    } else {
        // Insere os dados no banco de dados
        $query_insercao = "INSERT INTO pessoa_juridica(nomeEmpresa, cnpj, telefonePJ, emailPJ, senhaPJ) VALUES ('$nomeEmpresa', '$cnpj', '$telefonePJ', '$emailPJ', '$senhaPJ')";
        $resultado_insercao = mysqli_query($conexao, $query_insercao);

        if ($resultado_insercao) {
            echo "<script>window.location.href='http://localhost/Inova%20Start/Inova%20Start/Login/login.html';</script>";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Formulário não submetido.";
}
?>