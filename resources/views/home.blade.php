@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <!-- Patients Card -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-blue-100 border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Patients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $patients }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Doctors Card -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-blue-100 border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doctors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $doctors }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Appointments Card -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-blue-100 border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointments }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Revenue Card -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-blue-100 border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Revenue</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $revenue }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Recent Appointments -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header bg-info text-white">
                                    Recent Appointments
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Patient</th>
                                                <th>Doctor</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentAppointments as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                                                    <td>{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                                                    <td>{{ $appointment->appointment_date }}</td>
                                                    <td><span class="badge badge-{{ $appointment->status == 'Completed' ? 'success' : 'warning' }}">{{ $appointment->status }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Patient Statistics -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header bg-success text-white">
                                    Patient Statistics
                                </div>
                                <div class="card-body">
                                    <canvas id="patientStatsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('patientStatsChart').getContext('2d');
    var patientStatsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($patientStats['labels']),
            datasets: [{
                label: '# of Patients',
                data: @json($patientStats['data']),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
