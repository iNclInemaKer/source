<?php
        function connect_to_db()
        {
            $dbengine   = 'mysql';
            $dbhost     = 'localhost';
            $dbuser     = 'root';
            $dbpassword = '';
            $dbname     = 'test';

            $this->pdo = null;
            try{
                $this->pdo = new PDO("mysql:dbhost=" . $this->dbhost . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpassword);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $pdo;
            }  
            catch (PDOException $e){
                $e->getMessage();
            }
            return $this->pdo;
        }
?>