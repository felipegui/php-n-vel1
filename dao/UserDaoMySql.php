<?php
    require_once 'models/User.php';

    class UserDaoMySql implements UserDao {
        private $pdo;

        public function __construct( PDO $driver ) {
            $this->pdo = $driver;
        }

        public function add(User $u) {
            $sql = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $sql->bindValue(':name', $u->getName());
            $sql->bindValue(':email', $u->getEmail());
            $sql->execute();

            $u->setId( $this->pdo->lastInsertId() );
        }
        
        public function findAll() {            
            $array = [];

            $sql = $this->pdo->query("SELECT * FROM users");
            if( $sql->rowCount() > 0 ) {
                $data = $sql->fetchAll();

                foreach( $data as $item ) {
                    $user = new User();
                    $user->setId($item['id']);
                    $user->setName($item['name']);
                    $user->setEmail($item['email']);

                    $array[] = $user;
                }
            }

            return $array;
        }

        public function findByEmail($email) {
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if( $sql->rowCount() > 0 ) {
                $data = $sql->fetch();

                foreach( $data as $item ) {
                    $user = new User();
                    $user->setId($item['id']);
                    $user->setName($item['name']);
                    $user->setEmail($item['email']);
                }
                return $user;
            } else {
                return false;
            }
        }
        
        public function findById($id) {
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if( $sql->rowCount() > 0 ) {
                $data = $sql->fetch();              

                $user = new User();
                $user->setId($data['id']);
                $user->setName($data['name']);
                $user->setEmail($data['email']);
                return $user;
            } else {
                return false;
            }
        }
        
        public function update(User $u) {
            $sql = $this->pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $sql->bindValue(':name', $u->getName());
            $sql->bindValue(':email', $u->getEmail());
            $sql->bindValue(':id', $u->getId());
            $sql->execute();

            //Opcional ou talvez não
            //return true;
        }
        
        public function delete($id) {
            $sql = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            
        }
    }
?>