<?php  
if (isset($_POST['pesquisar'])) {
    $pesquisar = $_POST['pesquisar'];
    $sql = "select * from professor where Nome LIKE '%$pesquisar%' OR `BI` LIKE '%$pesquisar%' OR `Apelido` LIKE '%$pesquisar%'";
    $execute = mysqli_query($conectar, $sql) or die(mysql_error());
}


?>