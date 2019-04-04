<div class="row">
    <div class="col col-md-3 col-lg-3 ">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header">Headlines</div>
            <div id="headline" class="card-body">
                <?php
                    headlineList();
                ?>
            </div>
        </div>
    </div>
    <div class="col col-lg-9">
        <div class="card text-white bg-secondary">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <span class="align-middle">Requirements</span>    
                    </div>
                    <!--
                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#newRequirement">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    -->
                </div>
            </div>
            <div id="req" class="card-body">
                <table id='mytableofrows' class='table table-hover table-dark'>
                    <thead>
                        <tr>
                            <th>ID</th>    
                            <th>Description</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            getRequirements();  
                        ?>
                    </tbody>    
                </table>
            </div>
        </div>
    
    </div>
</div>




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
                                    <input type="range" min="0" max="100" value="0" class="slider" id="progressSlider">
                                    <p>Value: <span id="sliderValue"></span></p>
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


<!-- Modal for editing requirements -->
<div class="modal fade" id="editRequirement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                    <input type="range" min="0" max="100" value="0" class="slider" id="progressSlider">
                                    <p>Value: <span id="sliderValue"></span></p>
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







<!-- Modal for selecting position -->
<!--
<div class="modal fade" id="selectPosition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Postion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    //headlineAccordion();
                ?>
                <form action="" method="post">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pos-x" id="pox-x-before" value="before">
                        <label class="form-check-label" for="pox-x-before">before</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pos-x" id="pox-x-after" value="after">
                        <label class="form-check-label" for="pox-x-after">after</label>
                    </div>  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
-->












<!-- JavaScript Slider -->
<script>
    var slider = document.getElementById("progressSlider");
    var output = document.getElementById("sliderValue");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function () {
        output.innerHTML = this.value;
    }



</script>