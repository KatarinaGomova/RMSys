<!-- Modal for new requirements -->
<div class="modal fade" id="showDeletedReq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleted Requirements</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Description</th>
                            <th scope="col">User</th>
                            <th scope="col">Date & Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php showDeletedReq(); ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <input type="input" value="null" name="projectId" id="projectId">
                <input type="input" value="null" name="selectedReq" id="selectedReq">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>