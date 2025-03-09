<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-1">📖 Student Grade Report</h4>
            <p class="mb-0"><strong>👨‍🎓 Student Name:</strong> {{ $student->name }}</p>
            <p class="mb-0"><strong>📚 Enrolled Course:</strong> {{ $course }}</p>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $subject => $grade)
                        <tr>
                            <td>{{ $subject }}</td>  {{-- Subject name --}}
                            <td>{{ $grade ?? 'N/A' }}</td>  {{-- Grade --}}
                            <td>

                            <span 
                                    @if($remarks[$subject] == 'Pass') class="text-success font-weight-bold"
                                    @elseif($remarks[$subject] == 'Failed') class="text-danger font-weight-bold"
                                    @else class="text-muted"
                                    @endif
                                         >
                    {{ $remarks[$subject] ?? 'N/A' }}
                </span>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No grades available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


