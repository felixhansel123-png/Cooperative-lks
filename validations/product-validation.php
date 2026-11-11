<?php
function validateProduct($data)
{
    $errors = [];
    if ($data['product_code'] === '') {
        $errors['product_code'] = "Kode produk wajib diisi.";
    }
    if ($data['product_name'] === '') {
        $errors['product_name'] = "Nama produk wajib diisi.";
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
    if (!is_numeric($data['stock']) || $data['stock'] < 0) {
        $errors['stock'] = "Stok harus berupa angka, minimal 0.";
    }
    if ($data['entry_date'] === '') {
        $errors['entry_date'] = "Tanggal masuk wajib diisi.";
    }

    return $errors;
}
