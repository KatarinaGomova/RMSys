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

function projectVal() {
    var name = $('#selectProject>option:selected').html();
    // funktioniert nicht 
    //document.getElementById('project').innerhtml() = name;
}

function setRequirement(id, projectId) {
    document.getElementById('selectedReq').value = id;
    document.getElementById('projectId').value = projectId;
}

function setAllReq(id, projectId, user, desc, progress, status, comment) {

}

function editingReq() {
    var reqId = $('#editselectedReq').val();
    //var position = 
    var description = $('#editReqDes').val();
    var status = $('#editReqStat').val();
    var progress = $('#editProgessSlider').val();
    var comment = $('#editReqComment').val();
    var projectId = $('#projectId').val();
}


function addingReq() {
    $(document).ready(function () {
        var reqId = $('#selectedReq').val();
        var position = $('.pos-y:checked').val();
        var description = $('#newReqDes').val();
        var status = $('#newReqStat').val();
        var progress = $('#newProgressSlider').val();
        var comment = $('#newReqComment').val();
        var projectId = $('#projectId').val();
        
        $.ajax({
            type: "POST",
            url: "src/ajaxToPHP/addNewReq.php",
            data: {
                id : reqId,
                pos : position,
                desc : description,
                stat : status,
                progress : progress,                           
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
        url: "src/ajaxToPHP/deleteReq.php",
        data: {
            reqId : id,
            order : order,
            parentId : parent
        },
        success: function() {
            //alert("Erfolgreich gelöscht!");
            window.location.assign("startpage.php");
            window.location.reload(true);
        },
        error: function () {
            alert("Es ist ein Fehler aufgetreten.");
        }
    });
        
}

function restoreReq() {
    // TODO: funktionalität der restoreReq schreiben
}