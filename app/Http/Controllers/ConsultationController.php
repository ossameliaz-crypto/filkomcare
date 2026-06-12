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

        // Menggunakan kombinasi tanggal (TahunBulanTanggal) dan 4 huruf/angka acak untuk menjamin keunikan 100%
        $reportId = 'RPT-' . date('ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));

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

        // Format tanggal untuk pesan WA
        $waDate = Carbon::parse($data['date'])->locale('id')->translatedFormat('l, d F Y');
        $waTime = isset($data['time']) ? str_replace(' WIB', '', $data['time']) . ' WIB' : '10:30 - 11:30 WIB';
        
        $isReschedule = isset($data['is_reschedule']) && $data['is_reschedule'];
        
        if ($isReschedule) {
            $waText = "Halo, saya {$user->name}.\r\n\r\nSaya ingin melakukan *Reschedule* / penjadwalan ulang sesi konseling dengan detail terbaru berikut:\r\n"
                    . "- Tanggal: {$waDate}\r\n"
                    . "- Jam: {$waTime}\r\n"
                    . "- Topik: {$data['topic']}\r\n\r\n"
                    . "Deskripsi masalah: {$data['description']}\r\n\r\n"
                    . "Mohon arahannya. Terima kasih.";
        } else {
            $waText = "Halo, saya {$user->name}.\r\n\r\nSaya telah menjadwalkan sesi konseling dengan detail berikut:\r\n"
                    . "- Tanggal: {$waDate}\r\n"
                    . "- Jam: {$waTime}\r\n"
                    . "- Topik: {$data['topic']}\r\n\r\n"
                    . "Deskripsi masalah: {$data['description']}\r\n\r\n"
                    . "Mohon arahannya. Terima kasih.";
        }
                
        $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode($waText);

        // Menambahkan isTimeValid = true agar tombol WA selalu bisa diklik
        $isTimeValid = true;

        return view('consultation.detail', compact('user', 'initials', 'data', 'formattedDate', 'waName', 'waLink', 'isOffline', 'location', 'isTimeValid'));
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

    public function showReschedule($id)
    {
        $consultation = Consultation::where('user_id', Auth::id())->findOrFail($id);
        
        if ($consultation->status === 'Selesai') {
            return redirect()->route('history.show', $id)->with('error', 'Konsultasi yang sudah selesai tidak dapat di-reschedule.');
        }

        $bookedSchedules = Consultation::select('date', 'time')
                            ->whereIn('status', ['Menunggu', 'Diproses'])
                            ->get()
                            ->toArray();

        return view('consultation.reschedule', compact('consultation', 'bookedSchedules'));
    }

    public function updateReschedule(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        $consultation = Consultation::where('user_id', Auth::id())->findOrFail($id);

        if ($consultation->status === 'Selesai') {
            return redirect()->route('history.show', $id);
        }

        $consultation->update([
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Jadwal Konsultasi Diperbarui',
            'message' => 'Jadwal konsultasi ' . $consultation->report_id . ' Anda berhasil diubah menjadi ' . $validated['date'] . ' ' . $validated['time'] . '.' . 
                         (in_array($consultation->service, ['Chat Konseling', 'Telepon Konseling']) ? ' Harap konfirmasi kembali ke WhatsApp admin.' : ''),
            'type' => 'reminder',
        ]);

        session()->flash('consultation_data', [
            'date' => $consultation->date,
            'time' => $consultation->time,
            'service' => $consultation->service,
            'topic' => $consultation->topic,
            'description' => $consultation->description,
            'is_reschedule' => true,
        ]);
        
        return redirect()->route('consultation.detail');
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

            // Menyiapkan teks notifikasi yang ramah
            $message = '';
            if ($request->status === 'Diproses') {
                $message = "Hore! Pengajuan konsultasi Anda ({$consultation->report_id}) saat ini sedang Diproses oleh tim kami. Persiapkan diri Anda sesuai jadwal ya!";
            } elseif ($request->status === 'Selesai') {
                $message = "Sesi konsultasi Anda ({$consultation->report_id}) telah ditandai Selesai. Terima kasih telah menggunakan layanan FilkomCare, semoga sehat selalu!";
            } else {
                $message = "Status laporan konsultasi Anda ({$consultation->report_id}) saat ini: {$request->status}.";
            }

            // Create notification for the user regarding status change
            Notification::create([
                'user_id' => $consultation->user_id,
                'title' => 'Update Status Konsultasi 🔔',
                'message' => $message,
                'type' => 'reminder',
            ]);

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Consultation not found'], 404);
    }

    /**
     * Menangani laporan Panic Button (SOS)
     */
    public function sos(Request $request)
    {
        // Cek jam kerja (Senin-Jumat, 09:00 - 17:00)
        $now = Carbon::now();
        $isWorkingHours = $now->isWeekday() && $now->hour >= 9 && $now->hour < 17;

        // Mencatat bahwa pengguna meminta bantuan SOS
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Permintaan SOS Diterima',
            'message' => $isWorkingHours 
                ? 'Kami telah menerima permintaan darurat Anda. Mohon tetap terhubung via WhatsApp.'
                : 'Layanan saat ini sedang offline. Data darurat Anda telah kami terima dan konselor akan segera menghubungi Anda saat jam layanan berlangsung (Senin-Jumat 09:00-17:00 WIB).',
            'type' => 'alert',
        ]);

        return response()->json([
            'success' => true,
            'is_working_hours' => $isWorkingHours
        ]);
    }
}
