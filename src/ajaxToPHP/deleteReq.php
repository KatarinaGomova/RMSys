<?php
    require_once('../../dbconn.php');

    $reqId = $_POST['reqId'];
    $order = $_POST['order'];
    $parentId = $_POST['parentId'];
                
    echo "<script>alert(\"Löschen von {$reqId}\");</script>";

    // Searching for next requirements in order
    $anySiblings = $conn->query("SELECT * FROM requirements 
                                WHERE requirementsTypId = 2 
                                AND parentId = {$parentId} 
                                AND numericalOrder > {$order}
                                ORDER BY numericalOrder;");
    
    // If next requirements found ...
    if(!empty($anySiblings)) {
        
        // ... the order of 
        $conn->query("UPDATE requirements SET numericalOrder = numericalOrder - 1 
                        WHERE requirementsTypId = 2 
                        AND parentId = {$parentId} 
                        AND numericalOrder > {$order}
                        ORDER BY numericalOrder;");
        
    }

    $conn->query("UPDATE requirements SET deleted = 1 WHERE requirementsid = {$reqId};");

    // TODO: funktioniert noch nicht
    //if($affRows = (mysqli_affected_rows($resClehar) > 0)) {
    //    echo "<script>alert(\" Zeilen ".$affRows." gelöscht!\");</script>";
    //}

   
?>