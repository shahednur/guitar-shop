<?php 
class CategoryDB{
    public function getCategorys(){
        $db = Database::getDB();
        
        $query = "SELECT * FROM categories ORDER BY categoryID";
        try{
            $statement = $db->query($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            return $result;
        }catch(PDOException $e){
            display_db_error($e->getMessage());
        }
    }
    
    public function getCategory($category_id){
        $db = Database::getDB();
        
        $query = "SELECT * FROM categories
                  WHERE categoryID = '$category_id'";
        try{
            $statement = $db->query($query);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
            return $result;
        }catch(PDOException $e){
            display_db_error($e->getMessage());
        }
    }
}
?>