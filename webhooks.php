<?php

// Include file koneksi database
require('db_connection.php');

// Ambil data JSON
$json = file_get_contents('php://input');

// Ambil data Header
$headers = getallheaders();

// Ambil Maupedia signature
$callbackSignature = isset($headers['X-Maupedia-Signature']) ? $headers['X-Maupedia-Signature'] : '';

// Isi dengan API Signature anda
$privateKey = 'API_Signature_anda';

// Generate signature untuk dicocokkan dengan X-Maupedia-Signature
$signature = hash_hmac('sha256', $json, $privateKey);

// Validasi signature
if ($callbackSignature !== $signature) {
    exit('Invalid signature');
}

$data = json_decode($json);
$json = json_encode($json);

// Hentikan proses jika callback event-nya bukan update/create
if ('update' !== $headers['X-Maupedia-Event']) {
    exit('Invalid callback event, no action was taken');
}

//Ubah data status sesuai database anda
function MPStatus($x)
{
    if ($x == 'waiting') $str = 'Pending';
    if ($x == 'error') $str = 'Error';
    if ($x == 'success') $str = 'Success';
    return (!$str) ? 'Pending' : $str;
}

//Mulai proses transaksi
if (isset($headers['X-Maupedia-Type']) == 'prabayar') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi Prabayar
|--------------------------------------------------------------------------
*/
    $trxid = $data['trxid'];
    $status = MPStatus($data['status']);

    $data_pesanan = $conn->query("SELECT * FROM pembelian_pulsa WHERE oid = '$trxid' AND status IN ('Pending', '')");

    if ($data_pesanan->num_rows == 0) {
        exit('data tidak ditemukan: ' . $trxid);
    } else {
        while ($cek_pesanan = $data_pesanan->fetch_assoc()) {
            $trxid = $cek_pesanan['trxid'];
            $code = $cek_pesanan['code'];
            $note = $cek_pesanan['note'];
            $updated_at = $cek_pesanan['updated_at'];

            if ($conn->query("SELECT * FROM pembelian_pulsa WHERE oid = '$trxid' AND status = 'Pending'")->num_rows == 1) {
                $conn->query("UPDATE pembelian_pulsa SET status = '$status', date_up = '$updated_at', keterangan = '$note' WHERE oid = '$trxid'");
                if ($status == "Success") {
                    //Lakukan Aksi Lainnya

                    // Berikan response ke MauPedia
                    exit(json_encode(['status' => true]));
                }
            }
        }
    }
} else if (isset($headers['X-Maupedia-Type']) == 'pascabayar') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi pascabayar
|--------------------------------------------------------------------------
*/
    $trxid = $data['trxid'];
    $status = MPStatus($data['status']);

    $data_pesanan = $conn->query("SELECT * FROM pembelian_pascabayar WHERE oid = '$trxid' AND status IN ('Pending', '')");

    if ($data_pesanan->num_rows == 0) {
        exit('data tidak ditemukan: ' . $trxid);
    } else {
        while ($cek_pesanan = $data_pesanan->fetch_assoc()) {
            $trxid = $cek_pesanan['trxid'];
            $code = $cek_pesanan['code'];
            $note = $cek_pesanan['note'];
            $updated_at = $cek_pesanan['updated_at'];

            if ($conn->query("SELECT * FROM pembelian_pascabayar WHERE oid = '$trxid' AND status = 'Pending'")->num_rows == 1) {
                $conn->query("UPDATE pembelian_pascabayar SET status = '$status', date_up = '$updated_at', keterangan = '$note' WHERE oid = '$trxid'");
                if ($status == "Success") {
                    //Lakukan Aksi Lainnya

                    // Berikan response ke MauPedia
                    exit(json_encode(['status' => true]));
                }
            }
        }
    }

    // Berikan response ke MauPedia
    exit(json_encode(['status' => true]));
} else if (isset($headers['X-Maupedia-Type']) == 'socmed') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi socmed
|--------------------------------------------------------------------------
*/
    $trxid = $data['trxid'];
    $status = MPStatus($data['status']);

    $data_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$trxid' AND status IN ('Pending', '')");

    if ($data_pesanan->num_rows == 0) {
        exit('data tidak ditemukan: ' . $trxid);
    } else {
        while ($cek_pesanan = $data_pesanan->fetch_assoc()) {
            $trxid = $cek_pesanan['trxid'];
            $code = $cek_pesanan['code'];
            $note = $cek_pesanan['note'];
            $updated_at = $cek_pesanan['updated_at'];

            if ($conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$trxid' AND status = 'Pending'")->num_rows == 1) {
                $conn->query("UPDATE pembelian_sosmed SET status = '$status', date_up = '$updated_at', keterangan = '$note' WHERE oid = '$trxid'");
                if ($status == "Success") {
                    //Lakukan Aksi Lainnya

                    // Berikan response ke MauPedia
                    exit(json_encode(['status' => true]));
                }
            }
        }
    }

    // Berikan response ke MauPedia
    exit(json_encode(['status' => true]));
} else if (isset($headers['X-Maupedia-Type']) == 'game') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi game
|--------------------------------------------------------------------------
*/
    $trxid = $data['trxid'];
    $status = MPStatus($data['status']);

    $data_pesanan = $conn->query("SELECT * FROM pembelian_game WHERE oid = '$trxid' AND status IN ('Pending', '')");

    if ($data_pesanan->num_rows == 0) {
        exit('data tidak ditemukan: ' . $trxid);
    } else {
        while ($cek_pesanan = $data_pesanan->fetch_assoc()) {
            $trxid = $cek_pesanan['trxid'];
            $code = $cek_pesanan['code'];
            $note = $cek_pesanan['note'];
            $updated_at = $cek_pesanan['updated_at'];

            if ($conn->query("SELECT * FROM pembelian_game WHERE oid = '$trxid' AND status = 'Pending'")->num_rows == 1) {
                $conn->query("UPDATE pembelian_game SET status = '$status', date_up = '$updated_at', keterangan = '$note' WHERE oid = '$trxid'");
                if ($status == "Success") {
                    //Lakukan Aksi Lainnya

                    // Berikan response ke MauPedia
                    exit(json_encode(['status' => true]));
                }
            }
        }
    }

    // Berikan response ke MauPedia
    exit(json_encode(['status' => true]));
} else if (isset($headers['X-Maupedia-Type']) == 'digital') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi digital
|--------------------------------------------------------------------------
*/
    //Lakukan Aksi Lainnya

    // Berikan response ke MauPedia
    exit(json_encode(['status' => true]));
} else if (isset($headers['X-Maupedia-Type']) == 'deposit') {
    /*
|--------------------------------------------------------------------------
| Proses Transaksi deposit
|--------------------------------------------------------------------------
*/
    //Lakukan Aksi Lainnya

    // Berikan response ke MauPedia
    exit(json_encode(['status' => true]));
}
