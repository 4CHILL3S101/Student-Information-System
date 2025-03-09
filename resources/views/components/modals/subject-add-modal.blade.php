<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Subject</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubjectForm">
                    @csrf
                    <div class="form-group">
                        <label>Subject Name</label>
                        <input type="text" id="subjectName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total Units</label>
                        <input type="number" id="subjectUnits" name="units" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" id="subjectCode" name="code" class="form-control" required>
                    </div>
                    <button type="button" id="addSubjectBtn" class="btn btn-primary">Add Subject</button>
                </form>
            </div>
        </div>
    </div>
</div>
