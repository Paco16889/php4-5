
<?php

// Obtener todas las categorías
function findAll(PDO $conn): array {
    $sql = "SELECT * FROM category ORDER BY categoryId";
    $stmt = $conn->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Buscar categoría por ID
function findById(PDO $conn, int $id): array|false {
    $sql = "SELECT * FROM category WHERE categoryID = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Insertar una categoría
function create(PDO $conn, string $name, string $description): bool {
    $sql = "INSERT INTO category (categoryName, Description)
            VALUES (:name, :description)";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'name' => $name,
        'description' => $description
    ]);
}


// Actualizar una categoría
function update(PDO $conn, int $id, string $name, string $description): bool {
    $sql = "UPDATE category
            SET categoryName = :name,
                Description = :description
            WHERE categoryId = :id";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'id' => $id,
        'name' => $name,
        'description' => $description
    ]);
}


// Eliminar una categoría
function delete(PDO $conn, int $id): bool {
    $sql = "DELETE FROM category WHERE categoryId = :id";

    $stmt = $conn->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

?>
