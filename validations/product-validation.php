<?php
function validateProduct($data)
{
    $errors = [];

    if ($data['product_code'] === '') {
        $errors['product_code'] = "Kode produk wajib diisi.";
    } elseif (mb_strlen($data['product_code']) > 10) {
        $errors['product_code'] = "Kode produk maksimal 10 karakter.";
    }
    if ($data['product_name'] === '') {
        $errors['product_name'] = "Nama produk wajib diisi.";
    } elseif (mb_strlen($data['product_name']) > 100) {
        $errors['product_name'] = "Nama produk maksimal 100 karakter.";
    }
    if ($data['category'] === '') {
        $errors['category'] = "Kategori wajib dipilih.";
    }
    if ($data['unit'] === '') {
        $errors['unit'] = "Satuan wajib dipilih.";
    }
    if (!is_numeric($data['price']) || $data['price'] < 0) {
        $errors['price'] = "Harga harus berupa angka, minimal 0.";
    }
    if (!is_numeric($data['stock']) || $data['stock'] < 0 || floor((float) $data['stock']) != $data['stock']) {
        $errors['stock'] = "Stok harus berupa bilangan bulat, minimal 0.";
    }
    if (!isValidDate($data['entry_date'])) {
        $errors['entry_date'] = "Tanggal masuk tidak valid.";
    }
    return $errors;
}
