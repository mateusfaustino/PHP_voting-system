<?php
class Data{
    private $table;
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct($host, $dbname, $user, $password,$table){
        $this->host=$host;
        $this->dbname=$dbname;
        $this->user=$user;
        $this->password=$password;
        $this->table=$table;
        try {
            $pdo = new PDO(
                "mysql: host=".$this->host."; dbname=".$this->dbname,
                $this->user,
                $this->password
            );    
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //create
    public function insert(){
        $cmd = $pdo->prepare('INSERT INTO :table () VALUES()');
        $cmd->bindParam(':table',$this->table);
        $cmd->execute();
    }

    //read
    public function read($id){
        $cmd = $pdo->prepare('SELECT * FROM :table WHERE id=:id');
        $cmd->bindParam(':table',$this->table);
        $cmd->bindParam(':id',$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //update
    public function update($column, $value,$id){
        $cmd = $pdo->prepare('UPDATE :table SET :column = :value WHERE id=:id');
        $cmd->bindParam(':table',$this->table);
        $cmd->bindParam(':column',$column);
        $cmd->bindParam(':value',$value);
        $cmd->bindParam(':id',$id);
        $cmd->execute();
    }
    
    //delete
    public function delete($id){
        $cmd = $pdo->prepare('DELETE FROM :table WHERE id=:id');
        $cmd->bindParam(':table',$this->table);
        $cmd->bindParam(':id',$id);
        $cmd->execute();
    }
}

?>