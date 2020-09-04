<?php
    require 'config.php';
    require 'dao/UserDaoMySql.php';

    $userDao = new UserDaoMySql($pdo);

    $id = filter_input(INPUT_GET, 'id');

    if( $id ) {
        $userDao->delete( $id );

        /*$sql = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        */
    }

    header("Location: index.php");
    exit;
?>