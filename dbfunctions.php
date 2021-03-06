<?php
   

    function headlineList() {
        global $conn;
        global $projectId;

        echo "<div class='list-group list-group-flush headline-list'>";

        $results = $conn->query("SELECT * 
                                FROM requirements 
                                Where projectId = {$projectId}
                                AND parentId = 0 
                                AND requirementsTypId = 1
                                ORDER BY numericalOrder;");
        if ($results->num_rows) {
    
            foreach ($results as $result) {
                echo "<button type='button' class='list-group-item list-group-item-action'><b>".
                        $result['numericalOrder']."  ".$result['description'].
                    "</b></button>";

                $child_result = $conn->query("SELECT * 
                                                FROM requirements 
                                                WHERE projectId = {$projectId}
                                                AND parentId = {$result['requirementsId']} 
                                                AND requirementsTypId = 1
                                                ORDER BY numericalOrder;");

                foreach ($child_result as $child) {
                    echo "<button type='button' class='list-group-item list-group-item-action'>".
                                $result['numericalOrder'].".".$child['numericalOrder']."  ".$child['description'].
                        "</button>";

                    $child_child_result = $conn->query("SELECT *
                                                        FROM requirements
                                                        WHERE projectId = {$projectId}
                                                        AND parentId = {$child['requirementsId']}
                                                        AND requirementsTypId = 1
                                                        ORDER BY numericalOrder;");
                    
                    foreach ($child_child_result as $child_child) {
                        echo "<button type='button' class='list-group-item list-group-item-action'>".
                                $result['numericalOrder'].".".$child['numericalOrder'].".".$child_child['numericalOrder']."  ".$child_child['description'].
                            "</button>";
                    }
                }
            }
        } else {
            echo "No entries";
        }
        echo "</div>";
    }


    // don't know if needed 
    function headlineAccordion() {
        global $conn;
        global $projectId;

        echo "<div class='accordion' id='accordionExample'>";

        $results = $conn->query("SELECT * 
                                FROM requirements 
                                Where projectId = {$projectId}
                                AND parentId = 0 
                                AND requirementsTypId = 1
                                ORDER BY numericalOrder;");

        foreach ($results as $result) {
            echo "<button type='button' class='list-group-item list-group-item-action' data-toggle='collapse' data-target='#collapse{$result['requirementsId']}' aria-expanded='true' aria-controls='collapseOne'><b>".
                    $result['numericalOrder']."  ".$result['description'].
                "</b></button>";

            echo "<div id='collapse{$result['requirementsId']}' class='collapse show' data-parent='#accordionExample'>";
                 
                

            $child_result = $conn->query("SELECT * 
                                            FROM requirements 
                                            WHERE projectId = {$projectId}
                                            AND parentId = {$result['requirementsId']} 
                                            AND requirementsTypId = 1
                                            ORDER BY numericalOrder;");

            foreach ($child_result as $child) {
                echo "<button type='button' class='list-group-item list-group-item-action'>".
                            $result['numericalOrder'].".".$child['numericalOrder']."  ".$child['description'].
                    "</button>";

                $child_child_result = $conn->query("SELECT *
                                                    FROM requirements
                                                    WHERE projectId = {$projectId}
                                                    AND parentId = {$child['requirementsId']}
                                                    AND requirementsTypId = 1
                                                    ORDER BY numericalOrder;");
                
                foreach ($child_child_result as $child_child) {
                    echo "<button type='button' class='list-group-item list-group-item-action'>".
                            $result['numericalOrder'].".".$child['numericalOrder'].".".$child_child['numericalOrder']."  ".$child_child['description'].
                        "</button>";
                }
            }

            echo "</div>";


        }

        echo "</div>";

    }
    

    // funktioniert leider noch nicht
    function hiddenRow($dbDaten, $prefix) {
        global $projectId;
    

    echo "<tr>
            <td colspan='6' class='hiddenRow noHover'>
                <div id='{$prefix}{$dbDaten['requirementsId']}' class='collapse'>";
                    // TODO: Die Progress-Bar muss noch an die DB verknüpft werden
                    echo "
                        



                        <div class='card text-white bg-secondary border-dark'>
                            <div class='card-body'>
                                <div>
                                    <label for=''>Progress</label>
                                    <div class='progress'>
                                        <div class='progress-bar' role='progressbar' style='width: 25%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
                                    </div>
                                </div>
                                <div>
                                    <label for='disabledTextarea'>Comment</label>
                                    <textarea disabled class='form-control' id='disabledTextarea' rows='2'>{$dbDaten['comments']}</textarea>
                                </div>
                                <div>
                                    <label for=''>History</label>
                                    <table id='scrolltable' class='table table-sm'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>    
                                            <th>Operation</th>
                                            <th>What</th>
                                            <th>New Value</th>
                                            <th>Old Value</th>
                                            <th>User</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                showPartHistory($dbDaten['requirementsId']);

                          echo "    </tbody>
                                    </table>
                                </div>


                            
                            
                            </div>
                        </div>



                </div>
            </td>
        </tr>";
        return;

    }

    function buttonEditReq($dbData) {
        global $conn, $projectId;

        echo "  <button type='button' 
                        class='btn btn-outline-dark small' 
                        data-toggle='modal' 
                        data-target='#editRequirement'
                        onclick='setEditingReq({$dbData['requirementsId']},{$projectId});'>
                    <i class='fa fa-pencil'></i>
                </button>";
    }
   
    function buttonNewReq($dbData) {
        global $conn, $projectId;

        echo "  <button type='button' 
                        class='btn btn-outline-dark small' 
                        data-toggle='modal' 
                        data-target='#newRequirement'
                        onclick='setRequirement({$dbData['requirementsId']},{$projectId});'>
                    <i class='fa fa-plus'></i>
                </button>";
    }

    function buttonClearReq($dbData) {
        global $conn, $projectId;

        echo "  <button type='submit' 
                        value='{$dbData['requirementsId']}' 
                        name='btnClearReq' 
                        class='btn btn-outline-dark small' 
                        onclick='deletingReq({$dbData['requirementsId']},{$dbData['numericalOrder']},{$dbData['parentId']}, {$projectId}, {$_SESSION['userId']})';> 
                    <i class='fa fa-trash-o'></i>   
                </button>
            ";
    }

// TODO: Funktion mit Button fürs Löschen von Headlines erstellen
    function getRequirements() {
        global $conn;
        global $projectId;

        // 1.Headlines
        $results = $conn->query("SELECT * 
                                FROM requirements 
                                WHERE projectId = {$projectId}
                                AND parentId = 0 
                                AND requirementsTypId = 1
                                AND deleted = 0
                                ORDER BY numericalOrder;");
        
        if ($results->num_rows) {
            
            foreach ($results as $result) {
                echo "<tr data-toggle='collapse' data-target='#{$_SESSION['prefix']}{$result['requirementsId']}'>
                        <td>".$result['numericalOrder']."</td>
                        <td><b>".$result['description']."</b></td>
                        <td>".$result['requirementsStatusId']."</td>
                        <td></td>
                        <td>";
                            buttonNewReq($result);
                echo    "</td>
                        <td></td>
                    </tr>";
                    hiddenRow($result, $_SESSION['prefix']);

                // 1.Requirements
                $firstResReq = $conn->query("SELECT *
                                                FROM requirements
                                                LEFT JOIN requirementsstatus AS stat 
                                                ON (requirements.requirementsStatusId = stat.requirementsStatusId)
                                                WHERE projectId = {$projectId}
                                                AND parentId = {$result['requirementsId']}
                                                AND requirementsTypId = 2
                                                AND deleted = 0
                                                ORDER BY numericalOrder;");

                foreach ($firstResReq as $firstReq) {
                    
                    echo "<tr data-toggle='collapse' data-target='#{$_SESSION['prefix']}{$firstReq['requirementsId']}'>
                            <td>{$_SESSION['prefix']}{$firstReq['requirementsId']}</td>
                            <td>".$firstReq['description']."</td>
                            <td>{$firstReq['requirementsStatusName']}</td>
                            <td>";
                                buttonEditReq($firstReq);
                    echo    "</td>
                            <td>";
                                buttonNewReq($firstReq);
                    echo    "</td>
                            <td>";
                                buttonClearReq($firstReq);     
                    echo   "</td>
                        </tr>";
                        hiddenRow($firstReq, $_SESSION['prefix']);
                }

                // 2.Headlines
                $child_result = $conn->query("SELECT * 
                                                FROM requirements 
                                                WHERE projectId = {$projectId}
                                                AND parentId = {$result['requirementsId']} 
                                                AND requirementsTypId = 1
                                                AND deleted = 0
                                                ORDER BY numericalOrder;");
                
                foreach ($child_result as $child) {
                    echo "<tr>
                            <td>".$result['numericalOrder'].".".$child['numericalOrder']."</td>
                            <td>".$child['description']."</td>
                            <td></td>
                            <td></td>
                            <td>";
                                buttonNewReq($child);
                    echo " </td>
                            <td></td>
                        </tr>";
                    
                    //2.Requirements
                    $secResReq = $conn->query("SELECT *
                                                FROM requirements
                                                WHERE projectId = {$projectId}
                                                AND parentId = {$child['requirementsId']}
                                                AND requirementsTypId = 2
                                                AND deleted = 0
                                                ORDER BY numericalOrder;");
                    foreach ($secResReq as  $secReq) {
                        echo "<tr>
                                <td>
                                </td>
                                <td>".$secReq['description']."</td>
                                <td></td>
                                <td></td>
                                <td>";
                                    buttonNewReq($secReq);
                        echo   "</td>
                                <td>";
                                    buttonClearReq($secReq);
                        echo   "</td>
                            </tr>";
                    }


                    // 3.Headlines
                    $child_child_result = $conn->query("SELECT *
                                                        FROM requirements
                                                        WHERE projectId = {$projectId}
                                                        AND parentId = {$child['requirementsId']}
                                                        AND requirementsTypId = 1
                                                        AND deleted = 0
                                                        ORDER BY numericalOrder;");
                    
                    foreach ($child_child_result as $child_child) {
                        echo "<tr>
                                <td>".$result['numericalOrder'].".".$child['numericalOrder'].".".$child_child['numericalOrder']."</td>
                                <td>".$child_child['description']."</td>
                                <td></td>
                                <td></td>
                                <td>";
                                    buttonNewReq($child_child);
                        echo   "</td>
                                <td></td>
                            </tr>";
                    
                        // 3.Requirements
                        $thirdResReq = $conn->query("SELECT *
                                                        FROM requirements
                                                        WHERE projectId = {$projectId}
                                                        AND parentId = {$child_child['requirementsId']}
                                                        AND requirementsTypId = 2
                                                        AND deleted = 0
                                                        ORDER BY numericalOrder;");
                        foreach ($thirdResReq as $thirdReq) {
                            echo "<tr>
                                    <td>
                                    </td>
                                    <td>".$thirdReq['description']."</td>
                                    <td></td>
                                    <td></td>
                                    <td>";
                                        buttonNewReq($thirdReq);
                            echo   "</td>
                                    <td>";
                                        buttonClearReq($thirdReq);
                            echo   "</td>
                                </tr>";
                        }
                    }
                }
            }

        } else {
            echo "<tr><td colspan='6'>No entries</td></tr>";
        }

    }
    

    function showProjects($conn) {
  
        $output = '';

        $sql = $conn->query("SELECT projectId, projectName, prefix FROM project ORDER BY projectName;");

        while ($row = mysqli_fetch_array($sql)) {
            $output .= '<option value="'.$row["projectId"].'">'.$row["prefix"]." - ".$row["projectName"].'</option>';
        }

        return $output;
    }


    function createProject() {
        global $conn;

        if (isset($_POST['btnCreateProject'])) {
            
            $inputCreatePrefix = $_POST['inputCreatePrefix'];
            $inputCreateProject = $_POST['inputCreateProject'];

            $query = $conn->query("SELECT * FROM project WHERE prefix='{$inputCreatePrefix}'");

            // Check if prefix already exists
            if ($res = mysqli_fetch_object($query)) {
                echo "<script>alert(\"Project could not be created! Prefix already exists!\");</script>";
            } else {
                // create project
                $conn->query("INSERT INTO project (projectName, prefix) 
                            VALUES ('{$inputCreateProject}', '{$inputCreatePrefix}');");
               
                echo "<script>alert(\"Project created!\");</script>";
              
            }

        }
    }

    function showStatus($conn) {
        $output = '';

        $sql = $conn->query("SELECT * 
                                FROM requirementsstatus 
                                ORDER BY requirementsStatusId;");
        
        while ($row = mysqli_fetch_array($sql)) {
            $output .= "<option value='".$row['requirementsStatusId']."'>".$row['requirementsStatusName']."</option>";
        }

        return $output;
    }

    function prefixVal($projectId) {
        global $conn;

        $sql = $conn->query("SELECT prefix FROM project WHERE projectId = {$projectId};");
        while ($row = mysqli_fetch_array($sql)) {
            $_SESSION['prefix'] = $row['prefix'];
        }
    }

    function buttonRestore() {
        global $conn;

        // TODO: funktionalität der restore funktion schreiben
        echo "  <button type='submit' 
                        value='' 
                        name='btnClearReq' 
                        class='btn btn-outline-dark small' 
                        onclick='';> 
                    <i class='fa fa-share'></i>   
                </button>
            ";

    }



    function showDeletedReq() {
        global $conn, $projectId;

        $sql = $conn->query("SELECT p.prefix, r.requirementsId, r.description, u.firstName, u.lastName, r.creationDateTime
                            FROM requirements as r
                            LEFT JOIN usermanagement as u on (r.userId = u.userId)
                            LEFT JOIN project as p on (r.projectId = p.projectId)
                            WHERE r.projectId = {$projectId}
                            AND r.requirementsTypId = 2
                            AND r.deleted = 1
                            ORDER BY r.creationDateTime DESC;");
        
        while ($row = mysqli_fetch_array($sql)) {
            echo "<tr>
                        <th>{$row['prefix']}{$row['requirementsId']}</th>
                        <td>{$row['description']}</td>
                        <td>{$row['firstName']} {$row['lastName']}</td>
                        <td>{$row['creationDateTime']}</td>
                        <td>";
                        buttonRestore($row['requirementsId']);
            echo       "</td>
                    </tr>";
        }

    }


    function showAllHistory() {
        global $conn, $projectId;

        $sql = $conn->query("SELECT *
                            FROM history as h
                            LEFT JOIN project as p on (h.projectId = p.projectId)
                            LEFT JOIN usermanagement as u on (h.userId = u.userId)
                            WHERE h.projectId = {$projectId}
                            ORDER BY h.operationDateTime DESC;");

        while ($row = mysqli_fetch_array($sql)) {
        echo "<tr>
            <th>{$row['prefix']}{$row['requirementsId']}</th>
            <td>{$row['operation']}</td>
            <td>{$row['columnPlace']}</td>
            <td>{$row['newValue']}</td>
            <td>{$row['oldValue']}</td>
            <td>{$row['firstName']} {$row['lastName']}</td>
            <td>{$row['operationDateTime']}</td>
        </tr>";
        }

    }

    function showPartHistory($id) {
        global $conn, $projectId;

        $sql = $conn->query("SELECT p.prefix, h.requirementsId, h.operation, h.columnPlace, h.newValue, h.oldValue, u.firstName, u.lastName, h.operationDateTime
                            FROM history as h
                            LEFT JOIN project as p on (h.projectId = p.projectId)
                            LEFT JOIN usermanagement as u on (h.userId = u.userId)
                            WHERE h.projectId = {$projectId}
                            AND h.requirementsId = {$id}
                            ORDER BY h.operationDateTime DESC;");

        while ($row = mysqli_fetch_array($sql)) {
        echo "<tr>
            <th>{$row['prefix']}{$row['requirementsId']}</th>
            <td>{$row['operation']}</td>
            <td>{$row['columnPlace']}</td>
            <td>{$row['newValue']}</td>
            <td>{$row['oldValue']}</td>
            <td>{$row['firstName']} {$row['lastName']}</td>
            <td>{$row['operationDateTime']}</td>
        </tr>";
        }
    }


?>

