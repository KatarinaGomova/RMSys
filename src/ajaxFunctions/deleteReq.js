function deletingReq(reqId, numericalOrder, parentId, projectId, userId) {

    var project = projectId;
    var user = userId;
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
            projectId : project,
            userId : user,
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