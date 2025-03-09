<div class="content" style="min-height: auto; overflow: hidden;">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: 100%;">
                <div class="card-header">
                    <div class="row align-items-center w-100">
                        <div class="col-md-5">
                            <div class="input-group no-border mt-2">
                            <input type="text" id="searchInput" class="form-control " placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="nc-icon nc-zoom-split"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                Add Student
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body" style="height: 65vh; overflow-y: auto;">
                    <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                        <table class="table">
                            <thead class="text-primary">
                                <th>STUDENT ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th class="text-left">STATUS</th>
                            </thead>
                            <tbody id="student-table-body">
                                @foreach($student_list as $student)
                                    <tr>
                                        <td>{{ $student->student_id }}</td>
                                        <td class="student-name">{{ $student->name }}</td> <!-- Changed id to class -->
                                        <td>{{ $student->email }}</td>
                                        <td class="text-left">{{ $student->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modals.student-add-modal />
<x-modals.student-details-modal />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#student-table-body tr");

    rows.forEach(row => {
        let studentNameCell = row.querySelector(".student-name"); // Changed id to class
        if (studentNameCell) {
            let studentName = studentNameCell.textContent.toLowerCase();
            row.style.display = studentName.includes(filter) ? "" : "none";
        }
    });
});

</script>
