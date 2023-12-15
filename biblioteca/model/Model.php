<?php
    abstract class Model{
        private $connection;
        static private $classConnection;
        
        public function connectionIsOn(){
            return $this->connection != null;
        }

        public function getConnection(){
            return $this->connection;
        }
        public function setConnection($c){
            $this->connection = $c;
        }

        static public function createConnection(){
            if(Model::$classConnection == null){
                Model::$classConnection = new PDO("pgsql: host=localhost; port=5432; dbname=biblioteca; password=mqrlg; user=postgres");
                return Model::$classConnection;
            }
            return Model::$classConnection;
        }

        static public function modelBegin(){
            echo "begin;";
        }
        static public function modelRollback(){
            echo "rollbak;";
        }
        static public function modelCommit(){
            echo "commit;";
        }

        public abstract function insert($obj);
        public abstract function delete($id);
        public abstract function selectAll();
        public abstract function update($obj);
        public abstract function selectById($id);
       // public abstract function selectByWhere($q);
        
    }
?>