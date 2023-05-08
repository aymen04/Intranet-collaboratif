
<?php



    function deleteUser($idu) {

$dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

    try {
        $stmt = $dbh->prepare("DELETE FROM utilisateurs WHERE idu = :idu");
        echo $idu;
        $stmt->bindValue(':idu', $idu, PDO::PARAM_INT);
        $stmt->execute();

    } 

    catch(PDOException $e) {
        echo $e->getMessage();
        
    }
}


function deleteProject($idp) {

    $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');
    
        try {
            $stmt = $dbh->prepare("DELETE FROM projets WHERE idp = :idp");
            echo $idp;
            $stmt->bindValue(':idp', $idp, PDO::PARAM_INT);
            $stmt->execute();
    
        } 
    
        catch(PDOException $e) {
            echo $e->getMessage();
            
        }
    }

?>

