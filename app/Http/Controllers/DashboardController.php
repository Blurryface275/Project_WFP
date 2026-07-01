<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            // Jumlah dokter & member dari tabel users
            'total_doctors' => User::where('role', 'doctor')->count(),
            'total_members' => User::where('role', 'member')->count(),

            // Jumlah artikel — sesuaikan model/tabel jika berbeda
            'total_articles' => Article::count(),

            // Jumlah booking berdasarkan status
            'total_bookings' => Transaction::count(),
            'ongoing_bookings' => Transaction::where('status', 'pending')->count(),
            'finished_bookings' => Transaction::where('status', 'completed')->count(),
            'cancelled_bookings' => Transaction::where('status', 'cancelled')->count(),
        ];

        $chartData = $this->getBookingChartData();

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    private function getBookingChartData(): array
    {
        $months = [];
        $counts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->translatedFormat('M Y');
            $counts[] = Transaction::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $months,
            'data' => $counts,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
