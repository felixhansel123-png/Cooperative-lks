<?php
require_once __DIR__ . "/../../repositories/employee-repositories.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/employees/index.php");
}

$id = $_POST['id'] ?? '';

if (empty($id)) {
    header("Location: ../../pages/employees/index.php");
}

$data = [
    'employee_number' => trim($_POST['employee_number'] ?? ''),
    'full_name' => trim($_POST['full_name'] ?? ''),
    'gender' => $_POST['gender'] ?? '',
    'birth_date' => $_POST['birth_date'] ?? '',
    'position' => $_POST['position'] ?? '',
    'salary' => $_POST['salary'] ?? ''
];

$errors = validateEmployee(
    $data,
    getGenders(),
    getPositions()
);

if ($errors) {
    setFlash($errors, $data);
    header("Location: ../../pages/employees/edit.php?id=$id");
}

try {
    $pdo->beginTransaction();
    $query = "SELECT employee_id FROM employees
              WHERE employee_number = :employee_number
              AND employee_id != :id";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'employee_number' => $data['employee_number'],
        'id' => $id
    ]);
    if ($stmt->fetch()) {
        $pdo->rollBack();

        setFlash(["Nomor pegawai sudah digunakan."], $data);
        header("Location: ../../pages/employees/edit.php?id=$id");
    }
    $query = "UPDATE employees SET
                employee_number = :employee_number,
                full_name = :full_name,
                gender = :gender,
                birth_date = :birth_date,
                position = :position,
                salary = :salary
              WHERE employee_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute($data + ['id' => $id]);
    $pdo->commit();
    header("Location: ../../pages/employees/index.php");
    exit();
} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}