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







function restoreReq() {
    // TODO: funktionalität der restoreReq schreiben
}