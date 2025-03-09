<div class="content" style="height: auto; overflow: hidden;">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: 100%;">
                <div class="card-header">
                    <div class="row align-items-center w-100">
                    <div style="display: inline-flex; align-items: center; gap: 10px;margin-left:20px">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal">Add Subject</button>
                        <input type="text" id="searchInput" class="form-control w-auto " placeholder="Search..." style="height:38px">
                    </div>

                    </div>
                </div>

                <div class="card-body" style="height: 65vh; overflow-y: auto;">
                    <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                        <table class="table">
                            <thead class="text-primary" style="position: sticky; top: 0; background: white; z-index: 2;">
                                <th>SUBJECT ID</th>
                                <th>SUBJECT NAME</th>
                                <th>UNITS</th>
                                <th>SUBJECT CODE</th>
                            </thead>
                            <tbody id="subjectTableBody">
                                @forelse($subjects as $key => $subject)
                                    <tr>
                                        <td>{{ $subject->id }}</td>
                                        <td class="subject-name">{{ $subject->name }}</td>
                                        <td>{{ $subject->units }}</td>
                                        <td>{{ $subject->code }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No subjects found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modals.subject-add-modal />
<x-modals.subject-details-modal />

<script>
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>