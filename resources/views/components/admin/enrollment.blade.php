<div class="content" style="min-height: auto;">
    
    <div class="row">
        <div class="col-md-12 offset-md-0 ms-2">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Student Enrollment Form</h4>
                </div>
                
                <div class="card-body">
                <form action="{{ route('enroll-component.store') }}" method="POST">

                        @csrf

                        <!-- Row for Name and ID -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="student-grade">Select Student</label>
                                <select id="student-grade" name="student_id" class="form-control select2">
                                    <option value="">Select Student</option>
                                    @foreach ($unenrolled_students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student ID</label>
                                <input type="text" id="studentId" name="student_id" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Row for Year Level, Semester, and Course -->
                        <div class="row">
                          

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Semester</label>
                                <select id="student-semester" name="semester" class="form-control">
                                    <option value="">Select semester</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Course</label>
                                <select id="student-course" name="course_name" class="form-control">
                                    <option>Select course</option>
                                    @foreach ($course_details as $courseName => $courseCode)
                                        <option value="{{ $courseCode }}">{{ $courseName }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        

                        <!-- Minor Subjects -->
                        <div class="mb-3 w-auto">
                        <div class="mb-3 w-auto">
                    <label class="form-label">Select Subjects</label>
                    <select id="student-subjects" name="subjects[]" class="form-control select2" multiple>
                        @foreach ($fetched_subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->units }} units)</option>
                        @endforeach
                    </select>
                </div>
                        </div>
                        <div id="schedule-container"></div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Enroll</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body" >
                    <div class="table-responsive" style="max-height: 50vh; ">
                        
                        <table class="table">
                        <div class="input-group no-border mt-2">
                            <input type="text" id="searchInput" class="form-control " placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="nc-icon nc-zoom-split"></i>
                                    </div>
                                </div>
                            </div>
                            <thead class="text-primary" style="position: sticky; top: 0; background: white; z-index: 2;">
                                <th>STUDENT ID</th>
                                <th>STUDENT NAME</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            
                            </thead>
                            <tbody id="subjectTableBody">
                                @forelse($enrolled_students as $enrolled_student)
                                    <tr>
                                        <td>{{ $enrolled_student -> student_id }}</td>
                                        <td class="student-name">{{ $enrolled_student -> name }}</td>
                                        <td>{{ $enrolled_student ->status }}</td>
                                        <td>    
                                                <button class = "btn btn-warning" id ="editButton"> Edit </button>
                                                <button class="btn btn-danger" id="openDeleteModalBtn" data-bs-toggle="modal" data-bs-target="#confirmRemoveModal" data-id="{{ $enrolled_student->student_id }}"> Delete </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">There are no currently enrolled stduents.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-modals.confirm-remove-modal />
   <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include Bootstrap and Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/js/admin/enrollment_functions.js') }}"></script>
<script>
    var courseDetails = @json($course_details);
</script>