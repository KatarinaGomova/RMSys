function newReload() {
        $(document).ready(function() {
            $('#saveSelectedProject').click(function() {
                window.location.assign("startpage.php");
                window.location.reload(true);
            });
        });
}

function addingReq() {
    $(document).ready(function () {
        $('#addReq').click(function () {
            var reqId = this.val();
            
            $.ajax({
                type: "POST",
                url: "addNewReq.php",
                data: {id : reqId},
                success: function() {
                    alert("Erfolgreich eingefügt!");
                },
                error: function () {
                    alert("Es ist ein Fehler aufgetreten.");
                }
            });
        })
    })
}