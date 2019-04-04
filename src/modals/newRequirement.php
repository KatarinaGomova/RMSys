<!-- Modal for new requirements -->
<div class="modal fade" id="newRequirement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Requirement</h5>
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
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pos-y" type="radio" name="pos-y" id="pos-y-before" value="before">
                                    <label class="form-check-label" for="pos-y-before">before</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pos-y" type="radio" name="pos-y" id="pos-y-after" value="after" checked="checked">
                                    <label class="form-check-label" for="pos-y-after">after</label>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><textarea name="newReqDes" class="form-control" id="newReqDes" rows="3"></textarea></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select id="newReqStat" name="newReqStat" class="form-control">
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
                                    <input type="range" min="0" max="100" step="25" value="0" class="slider" id="newProgressSlider">
                                    <p>Value: <span id="newSliderValue"></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td><textarea name="newReqComment" class="form-control" id="newReqComment" rows="3"></textarea></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <input type="input" value="null" name="projectId" id="projectId">
                <input type="input" value="null" name="selectedReq" id="selectedReq">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addingReq();">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript Slider -->
<script>
    var slider = document.getElementById("newProgressSlider");
    var output = document.getElementById("newSliderValue");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function () {
        output.innerHTML = this.value;
    }

</script>