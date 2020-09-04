<?php
    require 'config.php';
    require 'dao/UserDaoMySql.php';

    $userDao = new UserDaoMySql($pdo);

    $id = filter_input(INPUT_GET, 'id');

    $info = [];

    if( $id ) {
        $user = $userDao->findById($id);
    } else if( $user === false ) {
        header("Location: index.php");
        exit;
    }
?>
<h1>Editar Usuário</h1>

<form method="POST" action="editar_action.php">
    <input type="hidden" name="id" value="<?=$user->getId();?>"/>

    <label>
        Nome:<br/>
        <input type="text" name="name" value="<?=$user->getName();?>"/>
    </label><br/></br>

    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?=$user->getEmail();?>"/>
    </label><br/></br>

    <input type="submit" value="Salvar alterações"/>
</form>