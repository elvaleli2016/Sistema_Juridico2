<?php
require_once __DIR__ . '/../../library/core/BaseController.php';
require_once __DIR__ . '/../model/services/ClienteService.php';
require_once __DIR__ . '/../model/dto/ClienteDTO.php';

/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 08/07/2016
 * Time: 07:39 PM
 */
class ClienteController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getFormularioRegistrarCliente(){
        $this->setView("cliente/registrarCliente");
    }

    public function getListadoClientes(){
        $this->setView("cliente/listarClientes");
    }
    // sirve
    public function getListarClientes(){
        $listado = $this->postListarClientes2();
        $json=json_encode(array("data"=>$listado));
       // $json .= '[{"dni" : "0925","nombre" : "Marlon", "apellido" : "Coronel","correo" : "marlon@gmail.com","telefono" : 5762777,"fechaNac" : "06/04/15"}]';
        echo $json;
    }
    public function postListarClientes2(){
        $servicio = new ClienteService();
        return $listadoDTO=$servicio->listar();
    }


    //sirve
    public function postRegistrar()
    {
         // @type UsuarioDTO
         $dto= new ClienteDTO();
         $dto->setDni(7);
         $dto->setApellido('coronel correa');
         $dto->setNombre('marlon yesid');
         $dto->setCorreo('marlonyasid09@gmail.com');
         $dto->setFecha_nac('2-4-2011');
         $dto->setTelefono('123456');
         
         $servicio= new ClienteService();
         $servicio->registrar($dto);
    }

    public function postActualizar(){
        // @type UsuarioDTO
        $dto= new ClienteDTO();
        $dto->setDni(7);
        $dto->setApellido('coronel correa actualizar');
        $dto->setNombre('marlon yesid actualizar');
        $dto->setCorreo('marlonyasid09@gmail.com act');
        $dto->setFecha_nac('2-4-2012');
        $dto->setTelefono('12gggg');

        $servicio= new ClienteService();
        $servicio->actualizar($dto);
    }

    public function postEliminarAbogado()
    {
        $dni = $_GET["dni"];
        $service = new ClienteService();
        $service->eliminar($dni);
    }


    public function getPruebaConexion()
    {
        // @type UsuarioDTO
        $dto = new UsuarioDTO();
        $dto->setDni(3);
        $dto->setApellido('oprdoez gayon');
        $dto->setNombre('miguel angel');
        $dto->setCorreo('marlonyasid09@gmail.com');
        $dto->setFecha_nac('2-4-2011');
        $dto->setTelefono('879478947');

        $servicio = new ClienteService();
        $servicio->registrar($dto);
        //@type Connection
//             
    }

}
