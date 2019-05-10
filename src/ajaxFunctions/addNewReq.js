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