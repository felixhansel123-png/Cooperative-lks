<?php
function validateEmployee($data, $genders, $positions)
{
    $errors = [];

    if ($data['employee_number'] === '') {
        $errors[] = "Nomor pegawai wajib diisi.";
    } elseif (mb_strlen($data['employee_number']) > 10) {
        $errors[] = "Nomor pegawai maksimal 10 karakter.";
    }

    if ($data['full_name'] === '') {
        $errors[] = "Nama lengkap wajib diisi.";
    } elseif (mb_strlen($data['full_name']) > 100) {
        $errors[] = "Nama lengkap maksimal 100 karakter.";
    }

    if (!in_array($data['gender'], $genders, true)) {
        $errors[] = "Jenis kelamin tidak valid.";
    }

    if (!isValidDate($data['birth_date'])) {
        $errors[] = "Tanggal lahir tidak valid.";
    } elseif ($data['birth_date'] > date('Y-m-d')) {
        $errors[] = "Tanggal lahir tidak boleh di masa depan.";
    }

    if (!in_array($data['position'], $positions, true)) {
        $errors[] = "Posisi tidak valid.";
    }

    if (!is_numeric($data['salary']) || $data['salary'] < 0 || $data['salary'] > 9999999999.99) {
        $errors[] = "Gaji harus berupa angka, minimal 0.";
    }

    return $errors;
}
