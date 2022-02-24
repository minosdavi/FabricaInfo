<?php
    $pdo = new PDO('mysql:host=localhost; dbname=clientes','root','');
    $pdo1 = new PDO('mysql:host=localhost; dbname=sexo', 'root', '');
    //$pdo->setAttribute(PDO::ERRMODE_EXCEPTION);

    //Delete
    if(isset($_GET['delete'])){
        $id = (int)$_GET['delete'];
        $pdo->exec("DELETE FROM clientes WHERE id=$id");
        $pdo1->exec("DELETE FROM sexo WHERE id_rel=$id");
        echo 'deletado com sucesso';
    }

    //insert.
    if(isset($_POST['nome'])){
        $sql  = $pdo ->prepare("INSERT INTO clientes VALUES (null, ?, ?)");
        $sql1 = $pdo1->prepare("INSERT INTO sexo VALUES (null,?,?)");
        $sql ->execute(array($_POST['nome'],$_POST['idade']));
        //var_dump($conn->lastInsertId());
        $id_cliente = $pdo->lastInsertId();
        $sql1->execute(array($_POST['sexo'],$id_cliente));
        echo 'inserido com sucesso!';
        
    }
?>

<form action="" method="post" >
    <input type="text" name="nome">
    <input type="number" name="idade">
    <input type="text" name="sexo">
    <input type="submit" value="enviar" name="" id="">
</form>

<?php

    $sql = $pdo->prepare("SELECT * FROM clientes");
    $sql->execute();

    $fetchClientes = $sql->fetchAll();

    foreach ($fetchClientes as $key => $value){
        echo '<a href="?delete='.$value['id'].'">(X)</a>'.$value['nome']. ' | '.$value['idade'];
        echo '<hr>';
    }

?>