<?php
    require 'config.php';
    require 'dao/UserDaoMySql.php';

    $userDao = new UserDaoMySql($pdo);

    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if( $id && $name && $email ) {
        $user = $userDao->findById($id);
        $user->setName($name);
        $user->setEmail($email);
        $userDao->update( $user );

        /*$sql = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':id', $id);
        $sql->execute();
        */

        header("Location: index.php");
        exit;
    } else {
        header("Location: editar.php?id=".$id);
        exit;
    }
?>