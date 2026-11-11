<?php
require_once __DIR__ . "/../../repositories/employee-repositories.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/employees/index.php");
    exit();
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
    header("Location: ../../pages/employees/create.php");
    exit();
}
try {
    $pdo->beginTransaction();
    $query = "SELECT employee_id FROM employees
              WHERE employee_number = :employee_number";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'employee_number' => $data['employee_number']
    ]);
    if ($stmt->fetch()) {
        $pdo->rollBack();

        setFlash(["Nomor pegawai sudah digunakan."], $data);
        header("Location: ../../pages/employees/create.php");
        exit();
    }
    $query = "INSERT INTO employees
              (employee_number, full_name, gender, birth_date, position, salary)
              VALUES
              (:employee_number, :full_name, :gender, :birth_date, :position, :salary)";

    $stmt = $pdo->prepare($query);
    $stmt->execute($data);
    $pdo->commit();
    header("Location: ../../pages/employees/index.php");
    exit();
} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}
