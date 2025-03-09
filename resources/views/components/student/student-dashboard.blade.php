<div class="row">
    <!-- Course Enrolled -->
    <div class="col-md-6">
        <div class="card bg-primary text-white shadow-lg p-5 text-center">
            <h3>📖 Enrolled Course</h3>
            <p class="fs-4"><strong>{{ $course }}</strong></p>
        </div>
    </div>

    <!-- GPA -->
    <div class="col-md-6">
        <div class="card bg-success text-white shadow-lg p-5 text-center">
            <h3>🎯 GPA</h3>
            <p class="fs-4"><strong>{{ number_format($gpa, 2) ?? 'N/A' }}</strong></p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Best Subject -->
    <div class="col-md-6">
        <div class="card bg-warning text-white shadow-lg p-5 text-center">
            <h3>🎖️ Best Subject</h3>
            <p class="fs-4"><strong>{{ $bestSubject ?? 'N/A' }} ({{ $bestGrade ?? 'N/A' }})</strong></p>
        </div>
    </div>

    <!-- Weakest Subject -->
    <div class="col-md-6">
        <div class="card bg-danger text-white shadow-lg p-5 text-center">
            <h3>📉 Weakest Subject</h3>
            <p class="fs-4"><strong>{{ $weakestSubject ?? 'N/A' }} ({{ $weakestGrade ?? 'N/A' }})</strong></p>
        </div>
    </div>
</div>
    