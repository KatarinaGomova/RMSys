<?php
    require_once('../../dbconn.php');

    $id = $_POST['id'];
    $desc = $_POST['desc'];
    //not sure if possition should be changed!
    //$pos = $_POST['pos'];
    $status = $_POST['stat'];
    $progress = $_POST['progress'];
    $comment = $_POST['comment'];
    $projectId = $_POST['projectId'];

    $conn->query("UPDATE requirements 
                    SET description = {},
                        comments = {},
                        creationDateTime = CURRENT_TIMESTAMP,
                        requirementsStatusId = {},
                        progress = {},
                        userId = {}
                    WHERE requirementsId = {};");

                                    

?>