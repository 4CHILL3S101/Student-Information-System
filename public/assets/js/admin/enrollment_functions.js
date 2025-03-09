document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default submission

        let form = this;
        let formData = new FormData(form);
    
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        let csrfTokenElement = document.querySelector('input[name="_token"]');
        if (!csrfTokenElement) {
            console.error("CSRF token not found");
            return;
        }

        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest", // Tells Laravel it's an AJAX request
                "X-CSRF-TOKEN": csrfTokenElement.value
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.errors) {
                let errorMessage = "<ul>";
                for (let field in data.errors) {
                    let errorElement = document.querySelector(`[name="${field}"]`);
                    if (errorElement) {
                        let errorDiv = document.createElement("div");
                        errorDiv.classList.add("text-danger");
                        errorDiv.innerText = data.errors[field][0];
                        errorElement.parentNode.appendChild(errorDiv);
                    }
                    errorMessage += `<li>${data.errors[field][0]}</li>`;
                }
                errorMessage += "</ul>";

                // Show errors in a SweetAlert modal
                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: errorMessage,
                });

            } else {
                // Success message
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Student enrolled successfully!",
                }).then(() => {
                    form.reset(); // Reset form
                    $(".select2").val(null).trigger("change"); // Reset Select2 fields
                    location.reload();
                });
            }
        })
        .catch(error => {
            let errorMessage = error.errors ? Object.values(error.errors).flat().join('<br>') : "Something went wrong. Please try again.";

            Swal.fire({
                icon: "error",
                title: "Oops!",
                html: errorMessage,
            });
            console.error("Error:", error);
        });
    });
});

$(document).ready(function () {
    // Initialize Select2 for the initial elements
    $('.select2').select2({
        placeholder: "Select an option",
        allowClear: true,
        width: '100%'
    });

    // Listen for changes in Course, Year Level, and Semester
    $('#student-course, #student-year, #student-semester').on('change', function () {
        console.log("Values changed", {
            course: $('#student-course').val(),
            year: $('#student-year').val(),
            semester: $('#student-semester').val()
        });
        updateSubjects();
    });

    function updateSubjects() {
        let selectedCourse = $('#student-course').val();
        let selectedYear = $('#student-year').val();
        let selectedSemester = $('#student-semester').val();
    
        console.log("Selected Values:", { selectedCourse, selectedYear, selectedSemester }); // Debugging
    
        // Prevent clearing subjects if selections are not complete
        if (!selectedCourse || !selectedYear || !selectedSemester) {
            console.log("Selection is incomplete. Not updating subjects.");
            return; // Don't clear subjects unnecessarily
        }
    
        console.log("Course Details Object:", courseDetails); // Debugging entire course structure
    
        // Check if course, year, and semester exist in courseDetails
        if (
            !courseDetails[selectedCourse] ||
            !courseDetails[selectedCourse][selectedYear] ||
            !courseDetails[selectedCourse][selectedYear][selectedSemester]
        ) {
            console.log("No subjects found for selected course, year, and semester.");
            $('#student-subjects').empty().append('<option value="">No subjects available</option>').trigger("change");
            return;
        }
    
        let subjects = courseDetails[selectedCourse][selectedYear][selectedSemester];
    
        console.log("Fetched Subjects:", subjects); // Debugging subjects list
    
        let subjectsDropdown = $('#student-subjects');
        subjectsDropdown.empty(); // Clear previous options
    
        if (subjects.length === 0) {
            subjectsDropdown.append('<option value="">No subjects available</option>');
        } else {
            subjects.forEach(subject => {
                subjectsDropdown.append(`<option value="${subject.id}">${subject.name}</option>`);
            });
        }
    
        // Reinitialize Select2 after modifying dropdown
        subjectsDropdown.trigger('change').select2({
            placeholder: "Select minor subjects",
            allowClear: true,
            width: '100%'
        });
    }
    

    // Handle Subject Selection for Instructors & Schedules
    $('#student-subjects').on('change', function () {
        let selectedSubjects = Array.from(this.selectedOptions).map(option => option.value);
        let scheduleContainer = $('#schedule-container');

        scheduleContainer.empty(); // Clear previous selections

        if (selectedSubjects.length === 0) {
            scheduleContainer.html('<p class="text-muted">No subjects selected.</p>');
            return;
        }

        selectedSubjects.forEach(subjectId => {
            let subjectOption = $('#student-subjects').find(`option[value="${subjectId}"]`);
            if (!subjectOption.length) return;

            let subjectName = subjectOption.text();

            console.log('Subject ID:', subjectId, 'Subject Name:', subjectName); // Add this line for debugging

            let rowDiv = $('<div class="row mb-3"></div>');

            rowDiv.append(`
                <div class="col-md-6">
                    <label class="form-label">Instructor for ${subjectName}</label>
                    <select name="instructors[${subjectId}]" class="form-control dynamic-select2">
                        <option value="">Select instructor</option>
                        <option value="Mr. Dagooc">Mr. Dagooc</option>
                        <option value="Ms. Rivera">Ms. Rivera</option>
                        <option value="Dr. Santos">Dr. Santos</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Schedule for ${subjectName}</label>
                    <select name="schedules[${subjectId}]" class="form-control dynamic-select2">
                        <option value="">Select schedule</option>
                        <option value="M-TH 7:30 - 9:00 AM">M-TH 7:30 - 9:00 AM</option>
                        <option value="M-TH 9:00 - 10:30 AM">M-TH 9:00 - 10:30 AM</option>
                        <option value="M-TH 10:30 - 12:00 PM">M-TH 10:30 - 12:00 PM</option>
                        <option value="M-TH 1:00 - 2:30 PM">M-TH 1:00 - 2:30 PM</option>
                        <option value="T-F 7:30 - 9:00 AM">T-F 7:30 - 9:00 AM</option>
                        <option value="T-F 9:00 - 10:30 AM">T-F 9:00 - 10:30 AM</option>
                    </select>
                </div>
            `);

            scheduleContainer.append(rowDiv);
        });

        // Reinitialize Select2 for dynamically added elements
        $('.dynamic-select2').select2({
            width: '100%'
        });
    });
});

$(document).ready(function() {
    // Listen for changes in the student dropdown
    $('#student-grade').on('change', function() {
        // Get the selected student's ID
        var selectedStudentId = $(this).val();
        
        // Set the student ID in the input field
        $('#studentId').val(selectedStudentId);
    });
});




document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#subjectTableBody tr");

    rows.forEach(row => {
        let studentNameCell = row.querySelector(".student-name"); // Changed id to class
        if (studentNameCell) {
            let studentName = studentNameCell.textContent.toLowerCase();
            row.style.display = studentName.includes(filter) ? "" : "none";
        }
    });
});

$(document).ready(function(){
    // Open Delete Modal
    $(document).on("click", "#openDeleteModalBtn", function(){
        let student_id = $(this).attr("data-id");
        $("#confirmDeleteBtn").attr("data-id", student_id); 
    });
    
    $(document).on("click", "#confirmDeleteBtn", function(){
        let studentId = $(this).attr("data-id"); 
     
        $.ajax({
            url: `/admin/enroll-component/${studentId}`,  // Make sure this is your route
            method: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token included
            },
            success: function(response) {
                $("#confirmRemoveModal").modal("hide");

                // Success Swal modal
                Swal.fire({
                    icon: 'success',
                    title: 'Student Deleted',
                    text: response.message, // response message from your controller
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page after success
                });
            },
            error: function(xhr) {
                $("#confirmRemoveModal").modal("hide");

                // Error Swal modal
                Swal.fire({
                    icon: 'error',
                    title: 'Delete Failed',
                    text: xhr.responseText, // Error message from the server
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
