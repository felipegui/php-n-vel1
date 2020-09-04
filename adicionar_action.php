<?php
    require 'config.php';
    require 'dao/UserDaoMySql.php';

    $userDao = new UserDaoMySql($pdo);

    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if( $name && $email ) {

        if ( $userDao->findByEmail($email) === false ) {
            $newUser = new User();
            $newUser->setName($name);
            $newUser->setEmail($email);

            $userDao->add( $newUser );

            header("Location: index.php");
            exit;
        } else {
            header("Location: adicionar.php");
            exit;
        }       
        
    } else {
        header("Location: adicionar.php");
        exit;
    }
?>