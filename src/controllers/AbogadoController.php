<?php
require_once __DIR__ . '/../../library/core/BaseController.php';
require_once __DIR__ . '/../model/dto/AbogadoDTO.php';
require_once __DIR__ . '/../model/services/AbogadoService.php';

/**
 * Created by PhpStorm.
 * User: McBro
 * Date: 16/11/2016
 * Time: 3:46 PM
 */
class AbogadoController extends BaseController
{

    /**
     * AbogadoController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getFormularioRegistrarAbogado()
    {
        $this->setView('abogado/registrarAbogado');
    }

    /**
     *
     */
    public function getlistadoAbogados()
    {

        $this->setView("abogado/listarAbogados");
    }

    public function postEliminarAbogado(){
        $dni = $_GET["dni"];
        $service = new AbogadoService();
        $service->eliminar($dni);
    }

    public function getListarAbogados()
    {

        $service = new AbogadoService();
        // retona un listadoAbogado<AbogadoDTO> forma de recorrer el array
        // foreach($listadoAbogado as $itemArray){
        //  $itemArray->metodoGet();
        //}
        $listadoAbogados = $service->listado();
        $json = '{"data" : ';
        $json .= json_encode($listadoAbogados);
        $json .= '}';
        echo $json;
    }

    /**
     *
     */
    public function postRegistrar()
    {

        $dni = $_POST["dni"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $fecha_nac = $_POST["fechaNac"];
        $telefono = $_POST["telefono"];
        $especialidad = $_POST["especialidades"];
        $almamater = $_POST["almamater"];
        $clave = $_POST["clave"];
        $dto = new AbogadoDTO();

        $dto->setDni($dni);
        $dto->setClave($clave);
        $dto->setApellido($nombre);
        $dto->setNombre($apellido);
        $dto->setCorreo($correo);
        $dto->setFecha_nac($fecha_nac);
        $dto->setTelefono($telefono);
        $dto->setAlmamater($almamater);
        //especialidades abogado
        $especialidad = json_decode($especialidad);

        //agrego las especialidades en un array al atributo especialidad de abogadoDTO
        $dto->setEspecialidad($especialidad);
        // servicio contiene la logica de negocio
        $serviceAbogado = new AbogadoService();
        $serviceAbogado->registrar($dto);

    }

    // en proceso de prueba creo que no sirve
    public function postActualizar()
    {
        $dni = $_POST["dni"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $fecha_nac = $_POST["fechaNac"];
        $telefono = $_POST["telefono"];
        $especialidad = $_POST["especialidades"];
        $almamater = $_POST["almamater"];
        $clave = $_POST["clave"];

        $dto = new AbogadoDTO();
        $dto->setDni(4);
        $dto->setApellido('jghf kljff');
        $dto->setNombre('kjjfnf klfjjf');
        $dto->setCorreo('nmvnnm@gmail.com');
        $dto->setFecha_nac('1-3-2018');
        $dto->setTelefono('009032');
        $dto->setAlmamater('upt');
        $dto->setClave($clave);
        $especialidad = json_decode($especialidad);
        $dto->setEspecialidad($especialidad);
        $serviceAbogado = new AbogadoService();
        $serviceAbogado->actualizar($dto);

    }
    // parametro url?nitAbogado=5
    // falta mostrar el array
    public function getListarEspecialiciones()
    {
        $nit = $_GET['nitAbogado'];
        $service = new AbogadoService();
        // array<EspecialidadDTO> de un abogado en especifico
        $service->listarEspecializaciones($nit);

    }
}
