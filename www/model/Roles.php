<?php
namespace core;
use \PDOException;
class Roles extends Model{

    private Model $parent;

    public function __construct(Model $parent){
        $this->parent = $parent;
    }


    public function getbyID($id){
        try {
            $sql = "SELECT Type FROM roles WHERE id=:id ";
            $stmt = $this->parent->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $q=$stmt->fetch();
            return $q;

        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getIDbyArg($arg){
        try {
            $sql = "SELECT id FROM Roles WHERE Type=:Type";
            $stmt = $this->parent->prepare($sql);
            $stmt->execute(['Type'=>$arg]);
            $q=$stmt->fetch();
            return $q;

        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }       
    }
}



?>