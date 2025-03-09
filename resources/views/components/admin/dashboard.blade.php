<div class="content">
    <div class="row">
        <!-- Cards displaying totals -->
        <div class="col-lg-4 col-md-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-globe text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">SUBJECTS OFFERED</p>
                                <p class="card-title">{{$total_subjects}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-money-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">ENROLLED STUDENTS</p>
                                <p class="card-title">{{$total_enrolled}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-paper text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Total Students</p>
                                <p class="card-title">{{$total_students}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">ENROLLMENT STATUS</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartHours" width="400" height="100"></canvas>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pass the PHP variables to JavaScript using json_encode
    var enrollmentMonths = {!! json_encode($months) !!};
    var enrollmentCounts = {!! json_encode($counts) !!};

    // Debug: Log the output to check for issues
    console.log(enrollmentMonths);
    console.log(enrollmentCounts);

    // Get the context of the canvas element
    var ctx = document.getElementById('chartHours').getContext('2d');

    // Create the line chart
    var chartHours = new Chart(ctx, {
        type: 'line',
        data: {
            labels: enrollmentMonths, // x-axis labels from your DB data (months)
            datasets: [{
                label: 'Enrollment',
                data: enrollmentCounts, // y-axis data from your DB
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Enrollment Status Over Time'
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Number of Enrollments'
                    }
                }
            }
        }
    });
</script>
