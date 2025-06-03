<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ScheduledMessageModel;

class ScheduleMessageController extends BaseController
{
    // Menampilkan halaman form untuk input pesan terjadwal
    public function index()
    {
        return view('schedule_message/index');
    }

    // Menyimpan data pesan terjadwal dari form input
    public function store()
    {
        $model = new ScheduledMessageModel();

        // Ambil input dari form
        $target = $this->request->getPost('target'); // misal: 08123456789
        $message = $this->request->getPost('message');
        // Format input schedule (misal: "2025-02-21 15:30") diubah menjadi Unix timestamp
        $scheduleInput = $this->request->getPost('schedule');
        $scheduleTimestamp = strtotime($scheduleInput);

        $data = [
            'target'   => $target,
            'message'  => $message,
            'schedule' => $scheduleTimestamp,
            'status'   => 'pending'
        ];

        $model->save($data);
        return redirect()->to('/schedule-message')->with('success', 'Pesan terjadwal berhasil disimpan.');
    }

    // Method yang dipanggil secara manual melalui tombol untuk mengirim pesan terjadwal
    public function sendNow()
    {
        $model = new ScheduledMessageModel();
        $currentTimestamp = time();

        // Ambil pesan dengan status pending dan schedule sudah tercapai (schedule <= waktu sekarang)
        $messages = $model->where('status', 'pending')
                          ->where('schedule <=', $currentTimestamp)
                          ->findAll();

        if (empty($messages)) {
            session()->setFlashdata('info', 'Tidak ada pesan terjadwal yang siap dikirim.');
            return redirect()->back();
        }

        $successCount = 0;
        $failCount = 0;
        foreach ($messages as $msg) {
            $result = $this->sendMessage($msg['target'], $msg['message'], $msg['schedule']);
            if ($result['success']) {
                $model->update($msg['id'], ['status' => 'sent']);
                $successCount++;
            } else {
                $model->update($msg['id'], ['status' => 'failed']);
                $failCount++;
            }
        }
        session()->setFlashdata('success', "Proses pengiriman selesai. Pesan berhasil: $successCount, gagal: $failCount.");
        return redirect()->back();
    }

    /**
     * Fungsi untuk mengirim pesan melalui Fonnte API.
     * Mengirim parameter 'schedule' agar Fonnte memproses penjadwalan (jika diperlukan).
     *
     * @param string $target Nomor WA tujuan
     * @param string $message Isi pesan
     * @param int $schedule Waktu jadwal (Unix timestamp)
     * @return array
     */
    private function sendMessage($target, $message, $schedule)
    {
        $apiUrl = 'https://api.fonnte.com/send';
        $token  = 'VWkExQrz1vUENMXxJDd1'; // Ganti dengan token Fonnte asli Anda
    
        // Data POST sesuai dengan dokumentasi Fonnte
        $postData = [
            'target'      => $target,
            'message'     => $message,
            'schedule'    => $schedule,
            'countryCode' => '62'
        ];
    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $postData,
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $token
            ],
        ]);
    
        $response = curl_exec($curl);
    
        // Debugging: Cek error jika ada
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            // Jika dijalankan melalui CLI, gunakan CLI::write()
            CLI::write("cURL error: " . $error_msg, 'red');
            // Jika dijalankan via web, bisa gunakan log_message() atau echo
            // log_message('error', "cURL error: " . $error_msg);
        }
    
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        CLI::write("HTTP Code: " . $httpCode, 'yellow');
    
        curl_close($curl);
    
        $resultData = json_decode($response, true);
        if ($httpCode == 200 && isset($resultData['success']) && $resultData['success'] === true) {
            return ['success' => true, 'data' => $resultData];
        } else {
            return ['success' => false, 'data' => $resultData];
        }
    }
    
}
