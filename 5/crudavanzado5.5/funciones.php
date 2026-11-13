
<?php

// Obtener todas las categorías
function findAll(PDO $conn): array
{
    $sql = "SELECT
                customers.customerNumber,
                customers.customerName,
                customers.contactLastName,
                customers.contactFirstName,
                customers.phone,
                customers.addressLine1,
                customers.addressLine2,
                customers.city,
                customers.state,
                customers.postalCode,
                customers.country,
                customers.salesRepEmployeeNumber,
                customers.creditLimit,
                employees.lastName
            FROM customers
            LEFT JOIN employees
                ON customers.salesRepEmployeeNumber = employees.employeeNumber
            ORDER BY customers.customerName";

    $stmt = $conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Buscar categoría por ID
function findById(PDO $conn, int $id): array|false
{
    $sql = "SELECT customers.customerNumber, customers.customerName,
                   customers.contactLastName, customers.contactFirstName,
                   customers.phone, customers.addressLine1, customers.addressLine2,
                   customers.city, customers.state, customers.postalCode,
                   customers.country, customers.salesRepEmployeeNumber,
                   customers.creditLimit, employees.lastName
            FROM customers
            LEFT JOIN employees
            ON customers.salesRepEmployeeNumber = employees.employeeNumber
            WHERE customers.customerNumber = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getEmployees(PDO $conn) {
    $sql = "SELECT employees.employeeNumber, employees.lastName
            FROM employees
            ORDER BY employees.lastName";

    $result = $conn->query($sql);

    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function getEmployeeById(PDO $conn, int $id): array|false
{
    $sql = "SELECT employees.employeeNumber, employees.lastName,
                   employees.firstName, employees.email
            FROM employees
            WHERE employees.employeeNumber = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Insertar una categoría
function create(
    PDO $conn,
    int $customerNumber,
    string $customerName,
    string $contactLastName,
    string $contactFirstName,
    string $phone,
    string $addressLine1,
    ?string $addressLine2,
    string $city,
    ?string $state,
    ?string $postalCode,
    string $country,
    ?int $salesRepEmployeeNumber,
    ?float $creditLimit
): bool {
    $sql = "INSERT INTO customers
                (customerNumber, customerName, contactLastName, contactFirstName, phone,
                 addressLine1, addressLine2, city, state, postalCode, country,
                 salesRepEmployeeNumber, creditLimit)
            VALUES
                (:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone,
                 :addressLine1, :addressLine2, :city, :state, :postalCode, :country,
                 :salesRepEmployeeNumber, :creditLimit)";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'customerNumber'         => $customerNumber,
        'customerName'           => $customerName,
        'contactLastName'        => $contactLastName,
        'contactFirstName'       => $contactFirstName,
        'phone'                  => $phone,
        'addressLine1'           => $addressLine1,
        'addressLine2'           => $addressLine2,
        'city'                   => $city,
        'state'                  => $state,
        'postalCode'             => $postalCode,
        'country'                => $country,
        'salesRepEmployeeNumber' => $salesRepEmployeeNumber,
        'creditLimit'            => $creditLimit
    ]);
}


// Actualizar una categoría
function update(
    PDO $conn,
    int $customerNumber,
    string $customerName,
    string $contactLastName,
    string $contactFirstName,
    string $phone,
    string $addressLine1,
    ?string $addressLine2,
    string $city,
    ?string $state,
    ?string $postalCode,
    string $country,
    ?int $salesRepEmployeeNumber,
    ?float $creditLimit
): bool {
    $sql = "UPDATE customers
            SET customerName = :customerName,
                contactLastName = :contactLastName,
                contactFirstName = :contactFirstName,
                phone = :phone,
                addressLine1 = :addressLine1,
                addressLine2 = :addressLine2,
                city = :city,
                state = :state,
                postalCode = :postalCode,
                country = :country,
                salesRepEmployeeNumber = :salesRepEmployeeNumber,
                creditLimit = :creditLimit
            WHERE customerNumber = :customerNumber";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'customerNumber'         => $customerNumber,
        'customerName'           => $customerName,
        'contactLastName'        => $contactLastName,
        'contactFirstName'       => $contactFirstName,
        'phone'                  => $phone,
        'addressLine1'           => $addressLine1,
        'addressLine2'           => $addressLine2,
        'city'                   => $city,
        'state'                  => $state,
        'postalCode'             => $postalCode,
        'country'                => $country,
        'salesRepEmployeeNumber' => $salesRepEmployeeNumber,
        'creditLimit'            => $creditLimit
    ]);
}


// Eliminar una categoría
function delete(PDO $conn, int $id): bool
{
    $sql = "DELETE FROM customers WHERE customerNumber = :id";

    $stmt = $conn->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

?>
