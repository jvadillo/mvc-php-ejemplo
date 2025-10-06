<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/EmpleadoModel.php';

class EmpleadoController extends BaseController {
    
    public function index() {
        $empleados = EmpleadoModel::getAll();
        $this->render('empleados/index.view.php', ['empleados' => $empleados]);
    }
    
    public function show() {
        $id = $_GET["id"];
        $empleado = EmpleadoModel::getById($id);
        $this->render('empleados/detalle.view.php', ['empleado' => $empleado]);
    }
    
    public function search() {
        $nombre = $_GET["nombre"];
        
        if($nombre != "") {
            $empleados = EmpleadoModel::getByName($nombre);
        } else {
            $empleados = EmpleadoModel::getAll();
        }
        
        $this->render('empleados/index.view.php', ['empleados' => $empleados, 'busqueda' => $nombre]);
    }
    
    public function store() {
        $empleado = array(
            "nombre" => $_GET["nombre"],
            "apellidos" => $_GET["apellidos"],
            "email" => $_GET["email"],
            "dni" => $_GET["dni"],
            "edad" => intval($_GET["edad"]),
            "fecha_nacimiento" => $_GET["fecha-nacimiento"],
            "curriculum" => $_GET["curriculum"],
            "sexo" => $_GET["sexo"]
        );
        
        EmpleadoModel::create($empleado);
        $this->redirect('index.php');
    }
    
    public function destroy() {
        $id = $_GET["id"];
        EmpleadoModel::deleteById($id);
        $this->redirect('index.php');
    }
    
    public function destroyAll() {
        EmpleadoModel::deleteAll();
        $this->redirect('index.php');
    }
}