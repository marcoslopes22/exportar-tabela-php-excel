<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Exportar Tabela</title>
</head>
<body>
    <?php
    //DEFINIR O NOME DO ARQUIVO
        $dataDownload   = date('dmY H:i');
        $nomeArquivo    = 'tabela-html' .$dataDownload. '.xls';
    //ADICIONANDO COMPONENTES HTML NA VARIÁVEL
        $html   = "";
        $html  .= "<table border='1'>";
        $html  .= "<tr>";
        $html  .= "<td colspan='4'><center><b>Título da tabela</b></center></td>";
        $html  .= "</tr>;";
        $html  .= "<tr>";
        $html  .= "<td><b>Coluna 1</b></td>";
        $html  .= "<td><b>Coluna 2</b></td>";
        $html  .= "<td><b>Coluna 3</b></td>";
        $html  .= "<td><b>Coluna 4</b></td>";
        $html  .= "</tr>";
    //CONEXÃO COM O BANCO DE DADOS
        include("./conexao.php");
        $conexao = new Conexao();
        $stmt = $conexao->prepare("SELECT * FROM table_name;");
        $stmt->execute();

        foreach($stmt as $row) {
            $html  .= "<tr>";
            $html  .= "<td>$row[column1]</td>";
            $html  .= "<td>$row[column2]</td>";
            $html  .= "<td>$row[column3]</td>";
            $html  .= "<td>$row[column4]</td>";
            $html  .= "</tr>";
        }
    //PREPARAR O DOWNLOAD
        header('Content-Type: text/html; charset=utf-8');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: ' . gmdate("D,d M YH:i:s") . ' GMT');
        header ('Cache-Control: no-cache, must-revalidate');
        header ('Pragma: no-cache');
        header ('Content-type: application/x-msexcel');
        header ("Content-Disposition: attachment; filename=$nomeArquivo");
        header ("Content-Description: PHP Generated Data" );
    //ENVIAR O DOWNLOAD
        echo $html;
        exit;
    ?>
</body>
</html>