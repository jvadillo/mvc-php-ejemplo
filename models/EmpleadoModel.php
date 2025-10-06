<?php
require_once __DIR__ . '/Database.php';

class EmpleadoModel {
    
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM empleado ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM empleado WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public static function getByName($nombre) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM empleado WHERE nombre LIKE :nombre");
        $stmt->execute(['nombre' => "%{$nombre}%"]);
        return $stmt->fetchAll();
    }
    
    public static function create($datos) {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO empleado (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum) 
                VALUES (:nombre, :apellidos, :email, :dni, :sexo, :edad, :fecha_nacimiento, :curriculum)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'nombre' => $datos['nombre'],
            'apellidos' => $datos['apellidos'],
            'email' => $datos['email'],
            'dni' => $datos['dni'],
            'sexo' => $datos['sexo'],
            'edad' => $datos['edad'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'curriculum' => $datos['curriculum']
        ]);
    }
    
    public static function deleteById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM empleado WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public static function deleteAll() {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM empleado");
        return $stmt->execute();
    }
}