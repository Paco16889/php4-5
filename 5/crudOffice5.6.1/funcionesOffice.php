<?php

// Obtener todas las oficinas
function findAllOffices(PDO $conn): array
{
    $sql = "SELECT 
                officeCode,
                city,
                phone,
                addressLine1,
                addressLine2,
                state,
                country,
                postalCode,
                territory
            FROM offices
            ORDER BY city";

    $stmt = $conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Buscar oficina por código
function findOfficeById(PDO $conn, string $id): array|false
{
    $sql = "SELECT 
                officeCode,
                city,
                phone,
                addressLine1,
                addressLine2,
                state,
                country,
                postalCode,
                territory
            FROM offices
            WHERE officeCode = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Insertar una oficina
function createOffice(
    PDO $conn,
    string $officeCode,
    string $city,
    string $phone,
    string $addressLine1,
    ?string $addressLine2,
    ?string $state,
    string $country,
    string $postalCode,
    string $territory
): bool {
    $sql = "INSERT INTO offices
                (officeCode, city, phone, addressLine1, addressLine2,
                 state, country, postalCode, territory)
            VALUES
                (:officeCode, :city, :phone, :addressLine1, :addressLine2,
                 :state, :country, :postalCode, :territory)";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'officeCode' => $officeCode,
        'city' => $city,
        'phone' => $phone,
        'addressLine1' => $addressLine1,
        'addressLine2' => $addressLine2,
        'state' => $state,
        'country' => $country,
        'postalCode' => $postalCode,
        'territory' => $territory
    ]);
}


// Actualizar una oficina
function updateOffice(
    PDO $conn,
    string $officeCode,
    string $city,
    string $phone,
    string $addressLine1,
    ?string $addressLine2,
    ?string $state,
    string $country,
    string $postalCode,
    string $territory
): bool {
    $sql = "UPDATE offices
            SET city = :city,
                phone = :phone,
                addressLine1 = :addressLine1,
                addressLine2 = :addressLine2,
                state = :state,
                country = :country,
                postalCode = :postalCode,
                territory = :territory
            WHERE officeCode = :officeCode";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'officeCode' => $officeCode,
        'city' => $city,
        'phone' => $phone,
        'addressLine1' => $addressLine1,
        'addressLine2' => $addressLine2,
        'state' => $state,
        'country' => $country,
        'postalCode' => $postalCode,
        'territory' => $territory
    ]);
}


// Eliminar una oficina
function deleteOffice(PDO $conn, string $id): bool
{
    $sql = "DELETE FROM offices WHERE officeCode = :id";

    $stmt = $conn->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

?>