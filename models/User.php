<?php
    class User {
        private $id;
        private $name;
        private $email;

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = trim($id);
        }

        public function getName() {
            return $this->name;
        }
        public function setName($name) {
            $this->name = ucwords(trim($name));
        }

        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = strtolower(trim($email));
        }
    }
    //Auxiliar na construção do CRUD
    interface UserDao {
        //C->Create
        public function add(User $u);
        //R->Read
        public function findAll();

        public function findByEmail($email);

        //R->Read(mais específico)
        public function findById($id);
        //U->Update
        public function update(User $u);
        //D->Delete
        public function delete($id);
    }
?>