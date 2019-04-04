<!-- Modal for editing requirements -->
<div class="modal fade" id="editRequirement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <table class="table table-dark">
                        <tr>
                            <td>Position</td>
                            <td>
                                 
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><textarea name="editReqDes" class="form-control" id="editReqDes" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select id="editReqStat" name="editReqStat" class="form-control" value="<?php //show status from db  ?>">
                                    <?php 
                                        echo showStatus($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Progress</td>
                            <td><!-- TODO: verschiebbare Progress-Bar -->
                                <div class="slidecontainer">
                                    <input type="range" min="0" max="100" value="<?php //show val from db ?>" step="25" class="slider" id="editProgressSlider">
                                    <p>Value: <span id="editSliderValue"></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td><textarea name="editReqComment" class="form-control" id="editReqComment" rows="3"></textarea></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <input type="input" value="null" name="editSelectedReq" id="editSelectedReq">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editingReq();">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript Slider -->
<script>
    var slider = document.getElementById("editProgressSlider");
    var output = document.getElementById("editSliderValue");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function () {
        output.innerHTML = this.value;
    }
    
</script>