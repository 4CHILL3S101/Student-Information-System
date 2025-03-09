
$(document).ready(function () {
    // Initialize Select2
    $('#student-id').select2({
        placeholder: "Select student",
        allowClear: true
    });

    $('#student-id').on('change', function () {
        let selectedOption = $(this).find(':selected');
        let subjects = selectedOption.data('subjects');
    
        console.log("Selected student's subjects (Raw Data):", subjects); // Debug
    
        let container = $('#subject-grade-container');
        container.html(''); // Ensures old data is removed before adding new ones
    
        if (subjects && typeof subjects === 'object' && Object.keys(subjects).length > 0) {
            $.each(subjects, function (subject, grade) {
                console.log("Adding Subject:", subject); // Debug
    
                let subjectRow = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SUBJECT</label>
                                <input type="text" class="form-control" value="${subject}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grade-${subject}">GRADE</label>
                                <select name="grades[${subject}]" class="form-control select2">
                                    <option disabled value="" ${grade === null ? 'selected' : ''}>Select grade</option>
                                    <option value="1.0" ${grade == 1.0 ? 'selected' : ''}>1.0 - Excellent</option>
                                    <option value="1.25" ${grade == 1.25 ? 'selected' : ''}>1.25 - Very Good</option>
                                    <option value="1.5" ${grade == 1.5 ? 'selected' : ''}>1.5 - Very Good</option>
                                    <option value="1.75" ${grade == 1.75 ? 'selected' : ''}>1.75 - Good</option>
                                    <option value="2.0" ${grade == 2.0 ? 'selected' : ''}>2.0 - Satisfactory</option>
                                    <option value="2.25" ${grade == 2.25 ? 'selected' : ''}>2.25 - Satisfactory</option>
                                    <option value="2.5" ${grade == 2.5 ? 'selected' : ''}>2.5 - Fair</option>
                                    <option value="2.75" ${grade == 2.75 ? 'selected' : ''}>2.75 - Fair</option>
                                    <option value="3.0" ${grade == 3.0 ? 'selected' : ''}>3.0 - Passing</option>
                                    <option value="5.0" ${grade == 5.0 ? 'selected' : ''}>5.0 - Failing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                container.append(subjectRow);
            });
    
            // Check if Select2 is already applied, then destroy it before reinitializing
            if ($('.select2').data('select2')) {
                $('.select2').select2('destroy');
            }
    
            $('.select2').select2();
        } else {
            console.error("Subjects are empty or malformed!");
        }
    });
    
    
    
    $('#grade-form').off('submit').on('submit', function (event) {
        event.preventDefault();
        let form = $(this)[0];
        let formData = new FormData(form);
        console.log(formData);

        let studentId = $('#student-id').val();  
        if (studentId) {
            formData.append('student_id', studentId); 
        } else {
            console.error("Student ID is missing.");
        }
    
        $('#subject-grade-container select').each(function() {  
            let subjectName = $(this).attr('name');
            console.log("Raw Subject Name:", subjectName); 
    
            if (subjectName && subjectName.match(/^grades\[(.*?)\]$/)) {
                let subjectMatch = subjectName.match(/grades\[(.*?)\]/); 
                console.log("Subject Match:", subjectMatch);  
    
                if (subjectMatch && subjectMatch[1]) {
                    let subject = subjectMatch[1];  
                    let grade = $(this).val();  
                    console.log("Selected Grade:", grade);
    
                    if (grade) {
                        formData.append(`grades[${subject}]`, grade);  // Append grade to FormData
                    } else {
                        console.error(`Grade for subject ${subject} is missing.`);
                    }
                } else {
                    console.error("Subject name is malformed or missing in the name attribute!");
                }
            } else {
                console.error("Subject name is missing or malformed in the 'name' attribute format!");
            }
        });
    
 $.ajax({
        url: $(form).attr('action'), 
        type: 'POST',
        data: formData,
        processData: false, 
        contentType: false,  
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            console.log("Server response:", response);
            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    html: response.message,
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    html: response.message,
                });
            }            
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                html: error,
            });
        }
        
    });
    });
});
