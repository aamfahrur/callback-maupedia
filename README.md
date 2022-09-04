# callback-maupedia
Callback adalah metode pengiriman notifikasi transaksi dari server Maupedia ke server penguna. Pada saat status transaksi sukses atau gagal, maka sistem Maupedia akan memberikan notifikasi yang berisi data transaksi yang kemudian dapat dikelola lebih lanjut oleh sistem pengguna.

# TODO
1. Tambahkan URL Callback anda di Pengaturan API MauPedia [Profile APIs](https://member.maupedia.com/account/profile)
2. Contoh Handle Callback ada di Webhooks.php pada repository ini, Sesuaikan dengan aplikasi anda.
3. Untuk Melihat Detail Contoh Isi / Content yang dikirim [Developer MauPedia](https://developer.maupedia.com/docs/2.2/webhooks)

Contoh Isi / Content yang dikirim
---------
### PRABAYAR

```json
{
    "trxid": "2232259873",
    "code": "TSEL1",
    "produk": "Telkomsel 1.000",
    "target": "08226541XXXX",
    "note": "0255020000131SUCCESS",
    "harga": "1200",
    "status": "success",
    "trxfrom": "API,36.81.9.115",
    "trxtype": "prepaid",
    "saldo_akhir": "50000",
    "created_at": "2021-12-25 05:29:48",
    "updated_at": "2021-12-25 06:50:03"
}
```

### FITUR GAME

```json
{
    "trxid": "2232259873",
    "code": "FF1300",
    "produk": "Free Fire 1300 Diamond",
    "target": "54123",
    "zone": "2323",
    "note": "0255020000131SUCCESS",
    "harga": "1200",
    "status": "success",
    "trxfrom": "API,36.81.9.115",
    "trxtype": "prepaid",
    "saldo_akhir": "50000",
    "created_at": "2021-12-25 05:29:48",
    "updated_at": "2021-12-25 06:50:03"
}
```

### SOSIAL MEDIA

```json
{
    "trxid": "2232259873123",
    "produk": "Instagram Likes Server 8",
    "target": "https:\/\/www.instagram.com",
    "note": "-",
    "custom_comments": "",
    "custom_link": "",
    "jumlah_order": "132",
    "harga": "200",
    "jumlah_awal": "324",
    "jumlah_kurang": "0",
    "status": "success",
    "trxfrom": "API,36.81.9.115",
    "saldo_akhir": "50000",
    "created_at": "2021-12-25 05:29:48",
    "updated_at": "2021-12-25 06:50:03"
}
```