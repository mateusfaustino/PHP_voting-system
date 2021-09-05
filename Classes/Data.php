<?php
class Data{
    private $table;
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $user, $password,$table){
        $this->host=$host;
        $this->dbname=$dbname;
        $this->user=$user;
        $this->password=$password;
        $this->table=$table;
        try {
            $this->pdo = new PDO(
                "mysql: host=".$this->host."; dbname=".$this->dbname,
                $this->user,
                $this->password
            ); 
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function exists($column,$value, $id_exception){
        $cmd = $this->pdo->prepare("SELECT id FROM phpcadastro.people WHERE ".$column." = :v");
        $cmd->bindValue(":v", $value);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        if ($cmd->rowCount() > 0 && $res["id"]!=$id_exception){
            return true;
        }else{
            return false;
        }
    }
    //create
    public function insert($name, $phone, $email){
        $cmd = $this->pdo->prepare('INSERT INTO '.$this->table.' (name, phone, email) VALUES(:n,:p,:e)');
        $cmd->bindParam(':n',$name);
        $cmd->bindParam(':p',$phone);
        $cmd->bindParam(':e',$email);
        $cmd->execute();
    }

    //read
    public function readOne($id){
            $cmd = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE id=:id');
            $cmd->bindParam(':id',$id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;  
    }

    //update
    public function update($column, $value,$id){
        $cmd = $this->pdo->prepare('UPDATE '.$this->table.' SET '.$column.'=:value WHERE id=:id');
        // $cmd->bindParam(':column',$column);
        $cmd->bindParam(':value',$value);
        $cmd->bindParam(':id',$id);
        $cmd->execute();
    }
    
    //delete
    public function delete($id){
        $cmd = $this->pdo->prepare('DELETE FROM '.$this->table.' WHERE id=:id');
        $cmd->bindParam(':id',$id);
        $cmd->execute();
    }
}

?>