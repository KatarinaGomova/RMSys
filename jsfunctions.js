function newReload() {
        $(document).ready(function() {
            $('#saveSelectedProject').click(function() {
                window.location.assign("startpage.php");
                window.location.reload(true);
            });
        });
}

function setRequirement(id) {
    document.getElementById('selectedReq').value = id;
}

function addingReq() {
    $(document).ready(function () {
        var reqId = document.getElementById('selectedReq');
        var position = document.getElementById('');
        
        $.ajax({
            type: "POST",
            url: "addNewReq.php",
            data: {
                id : reqId,
            },
            success: function() {
                alert("Erfolgreich eingefügt!");
            },
            error: function () {
                alert("Es ist ein Fehler aufgetreten.");
            }
            });
    });
}

function deletingReq(val) {
    
    var id = val;
    console.log(id);
    $.ajax({
        type: "POST",
        url: "delete.php",
        data: {reqId : id}
    });
        
}