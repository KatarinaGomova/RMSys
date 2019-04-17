<!-- Modal for new requirements -->
<div class="modal fade" id="showHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Operation</th>
                            <th scope="col">Column</th>
                            <th scope="col">New Value</th>
                            <th scope="col">Old Value</th>
                            <th scope="col">User</th>
                            <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php showAllHistory(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>