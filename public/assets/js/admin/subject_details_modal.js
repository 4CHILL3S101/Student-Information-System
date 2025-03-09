$(document).ready(function(){
    $(".table tbody tr").click(function(event){
        
        if ($(event.target).closest("button").length) {
            return;
        }

        var id = $(this).find("td:eq(0)").text().trim();
        var name = $(this).find("td:eq(1)").text().trim();
        var units = $(this).find("td:eq(2)").text().trim();
        var code = $(this).find("td:eq(3)").text().trim();

        $("#modalId").val(id);
        $("#modalName").val(name);
        $("#modalUnit").val(units);
        $("#modalCode").val(code);

        resetStudentModalFooter();
        $("#showStudentDetails").modal("show");
    });

    function resetStudentModalFooter() {
        let subjectId = $("#modalId").val(); 

        $(".modal-footer", "#showStudentDetails").html(`
            <button class="btn btn-danger" id="openDeleteModalBtn" data-bs-toggle="modal" data-bs-target="#confirmRemoveModal" data-id="${subjectId}">Delete</button>
            <button type="button" id="editBtn" class="btn btn-primary">Edit details</button>
        `);
    }

    $(document).on("click", "#editBtn", function(){
        $("#modalName, #modalUnit, #modalCode").prop("disabled", false);
        $(".modal-footer", "#showStudentDetails").html(`
            <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
            <button type="button" id="updateBtn" class="btn btn-success">Update</button>
        `);
    });

    $(document).on("click", "#cancelBtn", function(){
        $("#modalName, #modalUnit, #modalCode").prop("disabled", true);
        resetStudentModalFooter();
    });

    $(document).on("click", "#updateBtn", function(){
        let subjectId = $("#modalId").val();
        let updatedName = $("#modalName").val();
        let updatedUnits = $("#modalUnit").val();
        let updatedCode = $("#modalCode").val();

        $.ajax({
            url: `/admin/subject-component/${subjectId}`,
            method: "PUT",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: updatedName,
                units: updatedUnits,
                code: updatedCode
            },
            success: function(response) {
                alert("Subject updated successfully!");
                location.reload();
            },
            error: function(xhr) {
                console.error("Update failed:", xhr.responseText);
                alert("Update failed! " + xhr.responseText);
            }
        });
    });
    


    $(document).ready(function(){
    // Open Delete Modal
    $(document).on("click", "#openDeleteModalBtn", function(){
        let subjectId = $(this).data("id");

        console.log("Opening delete modal for Subject ID:", subjectId); 

        $("#confirmDeleteBtn").attr("data-id", subjectId); 
    });


    $(document).on("click", "#confirmDeleteBtn", function(){
        let subjectId = $(this).data("id"); 

        $.ajax({
            url: `/admin/subject-component/${subjectId}`,  
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
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    html: xhr.responseText,
                });
            }
        });
    });
});

});


