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
                    <div class="col text-right">
                        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#showDeletedReq">
                            Deleted
                        </button>
                    </div>
                </div>
            </div>
            <div id="req" class="card-body">
                <table id="mytableofrows" class="table table-hover">
                    <thead class="thead-dark"> 
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