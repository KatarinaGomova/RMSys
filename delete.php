<?php
    $reqId = $_GET['reqId'];

    if (isset($_POST['btnClearReq'])) {
                
        echo "<script>alert(\"Löschen von ".$reqId."\");</script>";

        $resClear = $conn->query("DELETE FROM requirements WHERE requirementsid = {$reqId};");

    }

?>