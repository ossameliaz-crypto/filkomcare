<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Consultation;
use App\Models\Notification;

class ConsultationController extends Controller
{
    public function index()
    {
        // Fetch all booked schedules to block them in UI
        $bookedSchedules = Consultation::select('date', 'time')
                            ->whereIn('status', ['Menunggu', 'Diproses'])
                            ->get()
                            ->toArray();

        return view('consultation.index', compact('bookedSchedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'service' => 'required|string',
            'topic' => 'required|string',
            'description' => 'required|string',
        ]);

        $count = Consultation::count() + 1;
        $reportId = 'RPT-' . date('y') . '-' . $count;

        Consultation::create([
            'user_id' => Auth::id(),
            'report_id' => $reportId,
            'topic' => $validated['topic'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'service' => $validated['service'],
            'status' => 'Menunggu',
        ]);

        // Create notification for the user
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Konsultasi anda diverifikasi',
            'message' => $reportId . ' sedang diproses admin',
            'type' => 'reminder',
        ]);

        // Send to Google Sheets Webhook
        $webhookUrl = env('GOOGLE_SHEET_WEBHOOK_URL');
        if ($webhookUrl) {
            try {
                \Illuminate\Support\Facades\Http::post($webhookUrl, [
                    'report_id' => $reportId,
                    'user_name' => Auth::user()->name,
                    'user_nim' => Auth::user()->nim ?? '-',
                    'topic' => $validated['topic'],
                    'description' => $validated['description'],
                    'date' => $validated['date'],
                    'time' => $validated['time'],
                    'service' => $validated['service'],
                ]);
            } catch (\Exception $e) {
                // Log error silently so it doesn't interrupt the user experience
                \Illuminate\Support\Facades\Log::error('Google Sheet Webhook Error: ' . $e->getMessage());
            }
        }

        session()->flash('consultation_data', $validated);
        
        return redirect()->route('consultation.detail');
    }

    public function detail()
    {
        $data = session('consultation_data');
        
        if (!$data) {
            return redirect()->route('consultation.index');
        }

        $user = Auth::user();
        
        // Calculate initials
        $nameParts = explode(' ', $user->name);
        $initials = '';
        foreach ($nameParts as $i => $part) {
            if ($i < 2) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }

        // Format Date
        $carbonDate = Carbon::parse($data['date'])->locale('id');
        $formattedDate = $carbonDate->translatedFormat('l, d F Y');

        // Extract WA Name and Number & Determine Offline
        $service = $data['service'];
        $waName = 'Whatsapp UKLT';
        $waNumber = '6281803805321'; // User requested number
        
        $offlineServices = ['Konselor Sebaya', 'UKLT Filkom', 'DWP Filkom'];
        $isOffline = in_array($service, $offlineServices);
        $location = 'Gedung A Fakultas Ilmu Komputer | Ruang UKLT';
        
        if ($service === 'Chat Konseling' || $service === 'Telepon Konseling') {
            $waName = 'Whatsapp FilkomCare';
        } elseif ($service === 'Konselor Sebaya') {
            $waName = 'Whatsapp Konselor';
        } elseif ($service === 'UKLT Filkom') {
            $waName = 'Whatsapp UKLT';
        } elseif ($service === 'DWP Filkom') {
            $waName = 'Whatsapp DWP';
        }

        $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode("Halo, saya {$user->name}. Saya ingin konseling mengenai topik: {$data['topic']}. \n\nDeskripsi: {$data['description']}");

        return view('consultation.detail', compact('user', 'initials', 'data', 'formattedDate', 'waName', 'waLink', 'isOffline', 'location'));
    }

    public function history()
    {
        $consultations = Consultation::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        return view('history.index', compact('consultations'));
    }

    public function showHistory($id)
    {
        $consultation = Consultation::where('user_id', Auth::id())->findOrFail($id);
        
        Carbon::setLocale('id');
        $formattedDate = Carbon::parse($consultation->date)->translatedFormat('j F Y');

        return view('history.show', compact('consultation', 'formattedDate'));
    }

    /**
     * Webhook Endpoint for Google Sheets to update status.
     * Expects JSON: { "report_id": "RPT-26-1", "status": "Diproses" }
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'report_id' => 'required|string',
            'status' => 'required|string|in:Menunggu,Diproses,Selesai',
        ]);

        $consultation = Consultation::where('report_id', $request->report_id)->first();

        if ($consultation) {
            $consultation->update([
                'status' => $request->status,
            ]);

            // Create notification for the user regarding status change
            Notification::create([
                'user_id' => $consultation->user_id,
                'title' => 'Pembaruan Status Konsultasi',
                'message' => 'Status laporan ' . $consultation->report_id . ' Anda sekarang: ' . $request->status,
                'type' => 'reminder',
            ]);

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Consultation not found'], 404);
    }
}
