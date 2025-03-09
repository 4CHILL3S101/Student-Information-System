<div class="content">
    <div class="row d-flex align-items-stretch h-100 justify-content-between"> 
        <div class="col-md-12 d-flex align-items-center h-100">
            <div class="card h-100 d-flex flex-column w-100 p-3">
                <div class="card-header">
                    <h5 class="card-title">ADD GRADE</h5>
                </div>
                <div class="card-body">
                <form id="grade-form" method="POST" action="{{ route('grades-component.store') }}">
                    @csrf
                        <div class="row">
                            <!-- Student Dropdown with Search -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student-id">STUDENT ID</label>
                                    <select id="student-id"  name="student_id" class="form-control select2">
                                        <option  value="">Select student</option>
                                        @foreach($enrollments as $enrollment)
                                            <option value="{{ $enrollment->student_id }}" 
                                                data-subjects='@json($enrollment->subjects ?? [])'>
                                                {{ optional($enrollment->student)->name ?? 'Unknown Student' }} ({{ $enrollment->student_id }})
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subject & Grade (Dynamic) -->
                        <div id="subject-grade-container"></div>

                        <!-- Submit Button -->
                        <div class="row m-1">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-round">SUBMIT GRADE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<!-- Include Select2 -->
<script src="{{ asset('assets/js/admin/grade_functions.js') }}"></script><!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load Select2 after jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Load SweetAlert (optional) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Your custom script -->
<script src="{{ asset('assets/js/admin/grade_functions.js') }}"></script>
