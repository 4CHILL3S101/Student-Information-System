<!-- Student Info Modal -->
<div class="modal fade" id="showStudentDetails" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3" style="border: none;">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="studentModalLabel">Student Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
            <input type="hidden" id="modalId">
                <!-- Student Image Centered -->
                <div class="d-flex justify-content-start mb-3">
                    <img id="modalImage" src="https://res.cloudinary.com/douasd2ik/image/upload/v1741259073/default_profile_m0o0wm.avif" alt="Student Image" class="border shadow-sm" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                </div>

                <!-- Editable Student Details -->
                <div class="p-3 rounded bg-light">
                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-primary" id="modalName" placeholder="name" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control text-dark" id="modalEmail" placeholder="email" disabled>
                            </div>
                        </div>
                    </div>


                    <!-- Year Dropdown -->
                   

                    <!-- Section Dropdown -->
                   

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex gap-3">
            <button class="btn btn-danger" id="openDeleteModalBtn"  data-bs-toggle="modal" data-bs-target="#confirmRemoveModal">Delete</button>
                <button type="button" id="updateProfileBtn" class="btn btn-primary">Edit details</button>
           </div>



        </div>
    </div>
</div>


<x-modals.confirm-remove-modal />
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="{{ asset('assets/js/admin/student_details_modal.js') }}"></script>

