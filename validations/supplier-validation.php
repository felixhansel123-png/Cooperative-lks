<?php
function validateSupplier($data, $allowedTypes)
{
    $errors = [];

    if ($data['supplier_name'] === '') {
        $errors[] = "Nama supplier wajib diisi.";
    } elseif (mb_strlen($data['supplier_name']) > 100) {
        $errors[] = "Nama supplier maksimal 100 karakter.";
    }

    if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    } elseif (mb_strlen($data['email']) > 100) {
        $errors[] = "Email maksimal 100 karakter.";
    }
    if (!preg_match('/^[0-9+\-\s()]{6,15}$/', $data['phone'])) {
        $errors[] = "Nomor telepon tidak valid (6-15 karakter, hanya angka, +, -, spasi, tanda kurung).";
    }
    if ($data['address'] === '') {
        $errors[] = "Alamat wajib diisi.";
    }
    if (empty($data['product_types'])) {
        $errors[] = "Pilih minimal satu jenis produk.";
    } else {
        foreach ($data['product_types'] as $type) {
            if (!in_array($type, $allowedTypes, true)) {
                $errors[] = "Jenis produk tiddak valid.";
                break;
            }
        }
    }
    if (!isValidDate($data['partnership_date'])) {
        $errors[] = "Tanggal kerja sama tidak valid.";
    } elseif ($data['partnership_date'] > date('Y-m-d')) {
        $errors[] = "Tanggal kerja sama tidak boleh di masa depan.";
    }
    return $errors;
}
