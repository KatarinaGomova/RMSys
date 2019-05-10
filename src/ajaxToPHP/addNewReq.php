<?php
    require_once('../../dbconn.php');
    session_start();
    

    $id = $_POST['id'];
    $desc = $_POST['desc'];
    $pos = $_POST['pos'];
    $status = $_POST['stat'];
    $progress = $_POST['progress'];
    $comment = $_POST['comment'];
    $projectId = $_POST['projectId'];

      
    $parentReq = $conn->query("SELECT * FROM requirements 
                                WHERE requirementsId = {$id};");

    if ($parent = mysqli_fetch_object($parentReq)) {
        
        switch ($pos) {
            case 'after':
                
                $conn->query("UPDATE requirements SET numericalOrder = numericalOrder + 1 
                                WHERE requirementsTypId = 2 
                                AND parentId = {$parent->parentId} 
                                AND numericalOrder > {$parent->numericalOrder} 
                                ORDER BY numericalOrder;");

                $conn->query("INSERT INTO requirements 
                                (numericalOrder, parentId, description,
                                comments, requirementsStatusId, progress, 
                                userId, projectId, requirementsTypId, deleted)
                                VALUES ({$parent->numericalOrder}+1, {$parent->parentId}, 
                                        '{$desc}', '{$comment}', {$status}, {$progress},
                                        {$_SESSION['userId']}, {$projectId}, 2, 0);");

                break;
            case 'before':

                $conn->query("UPDATE requirements SET numericalOrder = numericalOrder + 1 
                                WHERE requirementsTypId = 2 
                                AND parentId = {$parent->parentId} 
                                AND numericalOrder > {$parent->numericalOrder}-1 
                                ORDER BY numericalOrder;");

                $conn->query("INSERT INTO requirements 
                                (numericalOrder, parentId, description,
                                comments, requirementsStatusId, progress, 
                                userId, projectId, requirementsTypId, deleted)
                                VALUES ({$parent->numericalOrder}, {$parent->parentId}, 
                                        '{$desc}', '{$comment}', {$status}, {$progress},
                                        {$_SESSION['userId']}, {$projectId}, 2, 0);");

                break;
            default:
                // no default needed because there can only be "after" xor "before" 
                break;
        }


        // to access the id of the new requirement
        $newReqId = $conn->query("SELECT requirementsId FROM requirements 
                                WHERE projectId = {$projectId}
                                AND creationDateTime = (SELECT MAX(creationDateTime) FROM requirements);");

        if($newId = mysqli_fetch_array($newReqId)) {

            $conn->query("INSERT INTO history(projectId, requirementsId, userId, operation, tablePlace, columnPlace) 
            VALUES({$projectId},{$newId['requirementsId']},{$_SESSION['userId']},'insert','requirements','All');");
        }
       

    }


?>