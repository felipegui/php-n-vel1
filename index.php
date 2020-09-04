<html lang="pt-BR">
    <?php
        require 'config.php';
        require 'dao/UserDaoMySql.php';

        $userDao = new UserDaoMySql($pdo);

        $lista = $userDao->findAll();
    ?>

    <a href="adicionar.php">ADICIONAR USUÁRIO</a>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>AÇÕES</th>
        </tr>

        <?php foreach($lista as $user): ?>
            <tr>
                <td> <?=$user->getId(); ?> </td>
                <td> <?=$user->getName(); ?> </td>
                <td> <?=$user->getEmail(); ?> </td>
                <td>
                    <a href="editar.php?id=<?=$user->getId(); ?>">[ Editar ]</a>

                    <a href="excluir.php?id=<?=$user->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir?')">[ Excluir ]</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</html>
