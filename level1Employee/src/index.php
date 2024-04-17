<?php 
$input = $_REQUEST ?? []; 
$employee = $input['employee'] ?? []; 
$action = $input['action'] ?? []; 


function modificarSalario(array $employee){ 
        $employeeCopy = $employee; 
        $employeeCopy = calcualrEdad($employeeCopy); 
        $employeeCopy = calcualrAntiguedad($employeeCopy); 
        $employeeCopy = calcularPrestaciones($employeeCopy); 
        return $employeeCopy;
}

function calcualrEdad(array $employee){ 
    $employeeCopy = $employee;
    $birthDayemployee = $employeeCopy['birthdate']; 
    $birthDay = new DateTime($birthDayemployee); 
    $currentDate = new DateTime();  
    $age = $birthDay ->diff($currentDate); 
    $employeeCopy['age'] = $age->y; 
    return $employeeCopy; 
}

function calcualrAntiguedad(array $employee){
    $employeeCopy = $employee;
    $dateSeniorityEmployee = $employeeCopy['joindate'];
    $dateSeniority = new DateTime($dateSeniorityEmployee);
    $currentDate = new DateTime();
    $Seniority = $dateSeniority ->diff($currentDate);
    $employeeCopy['seniority'] = $Seniority->y;
    return $employeeCopy;
}

function calcularPrestaciones(array $employee){
    $employeeCopy = $employee;
    $salary = $employeeCopy['salary'];
    $seniority = $employeeCopy['seniority'];
    $benefits = $salary * $seniority * 1.12;
    $employeeCopy['benefits'] = $benefits;
    return $employeeCopy;
}

function changeEmployee(array $employee){
    $employeeCopy = $employee;
    $employeeCopy  = [];
    return $employeeCopy;
}

switch ($action) { 
    case 'modifySalary';
        $employee = modificarSalario($employee);
        break;
    case 'calculateAge';
        $employee = calcualrEdad($employee);
        break;
    case 'calculateSeniority';
        $employee = calcualrAntiguedad($employee);
        break;
    case 'calculateBenefits';    
        $employee = calcularPrestaciones($employee);
        break;
    case 'changeEmployee';
        $employee = changeEmployee($employee);
        break;
}


// echo "<pre>";
// print_r($employee);
// echo "</pre>";

?> 

<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Level 1 employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .card {
            width: 30rem; /* Ampliar el tamaño del card */
            /* Centrar el card horizontalmente */
            /* Espacio superior */
            margin: 20px auto 0;}
        .btn-custom-width {
            width: 200px; /* El ancho que desees */
            }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mt-5 mb-4">Información del Empleado</h2>
    <div class="card">
        <img src="public/img/perfil.png" class="card-img-top" alt="Foto del Empleado" id="employee-photo">
        <div class="card-body">
            <h5 class="card-title">Registro empleado</h5>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="gender">Género:</label>
                    <select name="employee[gender]" id="gender" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="firtsName">Nombre: </label>
                    <input type="text" class="form-control" id="firtsName" name="employee[firtsName]" value="<?php echo $employee['firtsName'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Apellidos:</label>
                    <input type="text" class="form-control" id="lastName" name="employee[lastName]" value="<?php echo $employee['lastName'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="company">Empresa: </label>
                    <input type="text" class="form-control" id="company" name="employee[comapy]" value="<?php echo $employee['compaby'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="job">Cargo:</label>
                    <input type="text" class="form-control" id="job" name="employee[job]" value="<?php echo $employee['job'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="birthdate" name="employee[birthdate]" value="<?php echo $employee['birthdate'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="joindate">Fecha de Ingreso:</label>
                    <input type="date" class="form-control" id="joindate" name="employee[joindate]" value="<?php echo $employee['joindate'] ?? '' ?>">
                </div>
                <button
                        type="submit"
                        class="btn btn-primary btn-custom-width"
                        id="update-salary-btn"
                        value="modifySalary"
                        name="action">
                        Calcular Información
                </button>
                <div class="form-group">
                    <label for="age">Edad:</label>
                    <input type="text" class="form-control" id="age" value="<?php echo $employee['age'] ?? ''?>">
                </div>
                <div class="form-group">
                    <label for="seniority">Antiguedad:</label>
                    <input type="text" class="form-control" id="seniority" value= "<?php echo $employee['seniority'] ?? '' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="salary">Salario Básico:</label>
                    <input type="text" class="form-control" id="salary" name="employee[salary]" value= "<?php echo $employee['salary'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="benefits">Prestaciones:</label>
                    <input type="text" class="form-control" id="benefits" value= "<?php echo $employee['benefits'] ?? '' ?>" readonly>
                </div>
                <hr>

                <button
                        class="btn btn-secondary btn-custom-width"
                        id="calculate-btn"
                        value="calculateAge"
                        name="action"
                >
                    Calcular Edad
                </button>
                <button class="btn btn-secondary btn-custom-width"
                        id="calculate-btn"
                        value="calculateBenefits"
                        name="action"
                >
                    Calcular Prestaciones
                </button>
                <button class="btn btn-secondary btn-custom-width"
                        id="calculate-btn"
                        name="action"
                        value="calculateSeniority"
                >
                    Calcular Antigüedad
                </button>
                <button
                        class="btn btn-info btn-custom-width"
                        id="change-employee-btn"
                        name="action"
                        value="changeEmployee"
                >
                    Cambiar Empleado
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
