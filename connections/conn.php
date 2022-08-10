<?php 
    # DATABASE
    $hostname_conn = "localhost";
    $database_conn = "sistemadb";
    $port_conn = "3306";

    # USER / PASS
    $username_conn = "root";
    $password_conn = "123";

    # CHARSET
    $charset_conn = "utf8";

    try
    {
        $conn = new PDO("mysql:host=$hostname_conn;dbname=$database_conn;port=$port_conn;charset=$charset_conn;", $username_conn, $password_conn);
    }
    catch ( PDOException $e )
    {
        echo 'Erro ao conectar com o MySQL: '.$e -> getMessage();
    }

    /*
    // Definindo parâmetros da conexão
    $conn2 = new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn, $port_conn);
    // Definindo conjunto de caracteres da conexão
    mysqli_set_charset($conn, $charset_conn);

    // Verificando possíveis erros de conexão
    
    if($conn -> connect_error) {
        echo "Erro: ".$conn -> connect_error;
    } else {
        // print_r($conn);
    }

    var_dump($conn);
    */
?>