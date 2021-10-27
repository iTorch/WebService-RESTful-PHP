<?php
include 'config/Conexion.php';
$pdo = new Conexion();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $sql = $pdo->prepare("SELECT * FROM contacts WHERE id =:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($sql->fetchAll());
        exit;
    } else {
        $sql = $pdo->prepare("SELECT * FROM contacts");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($sql->fetchAll());
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO contacts (name, phone, email) values (:name, :phone, :email)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $_POST['name']);
    $statement->bindValue(':phone', $_POST['phone']);
    $statement->bindValue(':email', $_POST['email']);
    $statement->execute();
    $lastid = $pdo->lastInsertId();
    if($lastid)
    {
        header('HTTP/1.1 210 OK');
        echo json_encode($lastid);
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $sql = "UPDATE contacts SET name=:name, phone=:phone, email=:email WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_GET['id']);
    $statement->bindValue(':name', $_GET['name']);
    $statement->bindValue(':phone', $_GET['phone']);
    $statement->bindValue(':email', $_GET['email']);
    $statement->execute();
    header('HTTP/1.1 200 OK');
    exit;

}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $sql = "DELETE FROM contacts WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_GET['id']);
    $statement->execute();
    header('HTTP/1.1 200 Eliminado con exito');
    exit;
}
header('HTTP/1.1 400 Bad Request');
?>
