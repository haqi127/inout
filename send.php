<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // === KONFIGURASI ===
    $token = "8703060544:AAHwZ_Kon_9dflixAnIDA_Wlr9ittFh3KV0";
    $admin1 = "7447271812";
    $admin2 = "CHAT_ID_ADMIN_2";

    // === DATA DARI FORM ===
    $tujuan   = $_POST['admin_tujuan'];
    $penerima = $_POST['penerima'];
    $pengirim = $_POST['pengirim'];
    $hp       = $_POST['hp'];
    $alamat   = $_POST['alamat'];
    $pesanan  = $_POST['pesanan'];

    // Penentuan Target
    $target_chat_id = ($tujuan == "admin1") ? $admin1 : $admin2;

    // === FORMAT PESAN (HTML) ===
    $message  = "✅ <b>PESANAN BARU TERDETEKSI</b>\n\n";
    $message .= "Penerima: <b>" . htmlspecialchars($penerima) . "</b>\n";
    $message .= "Pengirim: " . htmlspecialchars($pengirim) . "\n";
    $message .= "No. HP: " . htmlspecialchars($hp) . "\n";
    $message .= "Alamat: " . htmlspecialchars($alamat) . "\n\n";
    $message .= "Detail Pesanan:\n";
    $message .= "<b>" . htmlspecialchars($pesanan) . "</b>\n\n";
    $message .= "━━━━━━━━━━━━━━━";

    // === KIRIM MENGGUNAKAN CURL ===
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id'    => $target_chat_id,
        'text'       => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        echo "<script>
                alert('Berhasil terkirim! Silakan cek Telegram admin.');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "Gagal mengirim pesan.";
    }
}
?>
