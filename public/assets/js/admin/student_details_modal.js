
$(document).ready(function(){

    $(".table tbody tr").click(function(event){
    if ($(event.target).closest("button").length) {
        return;
    }
    var studentId = $(this).find("td:eq(0)").text().trim();
    var name = $(this).find("td:eq(1)").text().trim();
    var email = $(this).find("td:eq(2)").text().trim();
    var status = $(this).find("td:eq(5)").text().trim();  // Get student status

    // Update modal fields
    $("#modalId").val(studentId).data("status", status);  // Store status as data attribute
    $("#modalName").val(name);
    $("#modalEmail").val(email);

    $("#openDeleteModalBtn").attr("data-id", studentId);
    $("#showStudentDetails").modal("show");
})});


    function resetStudentModalFooter() {
        let subjectId = $("#modalId").val();

        $(".modal-footer", "#showStudentDetails").html(`
            <button class="btn btn-danger" id="openDeleteModalBtn" data-bs-toggle="modal" data-bs-target="#confirmRemoveModal" data-id="${subjectId}">Delete</button>
            <button type="button" id="editBtn" class="btn btn-primary">Edit details</button>
        `);
    }

    $(document).on("click", "#editBtn, #updateProfileBtn", function(){
    let status = $("#modalId").data("status"); // Retrieve stored status
    console.log("Student Status:", status);  // Debugging

    $("#modalName").prop("disabled", false); // Allow name editing

   
    $(".modal-footer", "#showStudentDetails").html(`
        <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
        <button type="button" id="updateBtn" class="btn btn-success">Update</button>
    `);
});




 
    $(document).on("click", "#updateProfileBtn", function(){
        $("#modalName").prop("disabled", false);

                // Change modal footer buttons
                $(".modal-footer", "#showStudentDetails").html(`
                    <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
                    <button type="button" id="updateBtn" class="btn btn-success">Update</button>
                `);
        });
                $(document).on("click", "#cancelBtn", function(){
            $("#modalName").prop("disabled", true);
            resetStudentModalFooter();
    });



$(document).on("click", "#updateBtn", function(){
    let studentId = $("#modalId").val();
    let updatedName = $("#modalName").val();

    $.ajax({
        url: `/admin/student-component/${studentId}`,
        method: "PUT",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: updatedName,
        },
        success: function(response) {
            Swal.fire({
                icon: "success",
                title: "Success",
                html: response.message,
            }).then(() => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    html: response.message,
                });
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: "error",
                title: "Error",
                html: response.message,
            });
        }
    });
});







$(document).ready(function(){
    // Open Delete Modal
    $(document).on("click", "#openDeleteModalBtn", function(){
        let student_id = $(this).attr("data-id");
        $("#confirmDeleteBtn").attr("data-id", student_id); 
    });

    //kwuaon niya ang confirm response sa confirmation modal apil and ID na gipasa as props sa
    $(document).on("click", "#confirmDeleteBtn", function(){
    let studentId = $(this).attr("data-id"); 

    $.ajax({
        url: `/admin/student-component/${studentId}`, 
        method: "DELETE",
        data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#confirmRemoveModal").modal("hide");
                $("#showStudentDetails").modal("hide");
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    html: response.message,
                }).then(() => {
                    location.reload(); 
                });
            },
        error: function(xhr) {
            alert("Delete failed! " + xhr.responseText);
        }
    });
});

});
