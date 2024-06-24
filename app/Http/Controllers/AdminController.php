<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Patient;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function Dashboard(Request $request){
        $patients = Patient::count();
        $doctors = Doctor::count();
        $appointments = Appointment::count();
        $revenue = Billing::sum('amount');

        $recentAppointments = Appointment::with('patient', 'doctor')->latest()->take(5)->get();

        // Sample data for patient statistics chart (could be fetched dynamically)
        $patientStats = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June'],
            'data' => [12, 19, 3, 5, 2, 3],
        ];

        return view('home', compact(
            'patients', 
            'doctors', 
            'appointments', 
            'revenue', 
            'recentAppointments', 
            'patientStats'
        ));
    }
}
