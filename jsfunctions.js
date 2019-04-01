// Nachdem Projekt ausgewählt wurde, funktioniert das laden trotzdem
// ohne diese Funktion
/*function newReload() {
        $(document).ready(function() {
            $('#saveSelectedProject').click(function() {
                window.location.assign("startpage.php");
                window.location.reload(true);
            });
        });
}*/

function setRequirement(id, projectId) {
    document.getElementById('selectedReq').value = id;
    document.getElementById('projectId').value = projectId;
}


function addingReq() {
    $(document).ready(function () {
        var reqId = $('#selectedReq').val();
        var position = $('.pos-y:checked').val();
        var description = $('#newReqDes').val();
        var status = $('#newReqStat').val();
        // progress
        var comment = $('#newReqComment').val();
        var projectId = $('#projectId').val();
        
        $.ajax({
            type: "POST",
            url: "addNewReq.php",
            data: {
                id : reqId,
                pos : position,
                desc : description,
                stat : status,                           
                comment : comment,
                projectId : projectId
            },
            success: function() {
                alert("Erfolgreich eingefügt!");
                window.location.assign("startpage.php");
                window.location.reload(true);
            },
            error: function () {
                alert("Es ist ein Fehler aufgetreten.");
            }
        });
    });
}


function deletingReq(reqId, numericalOrder, parentId) {

    var id = reqId;
    var order = numericalOrder;
    var parent = parentId;

    console.log(id);
    console.log(order);
    console.log(parent);

    $.ajax({
        type: "POST",
        url: "delete.php",
        data: {
            reqId : id,
            order : order,
            parentId : parent
        },
        success: function() {
            alert("Erfolgreich gelöscht!");
            window.location.assign("startpage.php");
            window.location.reload(true);
        },
        error: function () {
            alert("Es ist ein Fehler aufgetreten.");
        }
    });
        
}