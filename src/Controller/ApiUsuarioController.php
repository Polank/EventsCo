<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\View\View;
use App\Entity\Usuario;
use App\Entity\Vehiculo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ApiUsuarioController extends FOSRestController
{

/**
* GET Route annotation.
* @Get("/api/usuarios")
*/
public function getUsuarios()
{
  $repository = $this->getDoctrine()->getRepository(Usuario::class);

  $data = $repository->findAll();

  $view = $this->view($data, 200);
  $view->setFormat('json');
  return $this->handleView($view);
}

// /**
// * GET Route annotation.
// * @Get("/api/jugadorImatgen/{id}")
// */
// public function getjugadorImatge($id)
// {
//   $repository = $this->getDoctrine()->getRepository(Jugador::class);
//   $jugador = $repository->find($id);
//   $file = $this->getParameter('brochures_directory') . '/' . $jugador->getImagen();
//   //http://symfony.com/doc/current/components/http_foundation.html#serving-files
//   $response = new BinaryFileResponse($file);
//   $response->headers->set('Content-Type', 'image/jpeg');

//   return $response;
// }

/**
* GET Route annotation.
* @Get("/api/usuario/{id}")
*/
public function getUsuario($id) 
{
  $repository = $this->getDoctrine()->getRepository(Usuario::class);
  $usuario = $repository->find($id);

  $view = $this->view($usuario, 200);
  $view->setFormat('json');
  return $this->handleView($view);
}

/**
    * POST Route annotation.
    * @Post("/api/usuario")
    * @ParamConverter("usuario", converter="fos_rest.request_body")
    */
    public function insertarUsuario(Usuario $usuario)
    {
     //cerquem en la BDD la vehiculo enviada per Json
    //  $vehiculo= $this->getDoctrine()
    //     ->getRepository(Vehiculo::class)
    //     ->find($usuario->getVehiculo());

     //hem de crear un nou usuario per persistir-lo a la BDD
     $usuario0 = new Usuario();
     $usuario0->setNombre($usuario->getNombre());
     $usuario0->setApellidos($usuario->getApellidos());
     $usuario0->setUsername($usuario->getApellidos());
     $usuario0->setCorreo($usuario->getCorreo());
     $usuario0->setContrasena($usuario->getContrasena());

     //$usuario0->setVehiculo($vehiculo);

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($usuario0);
     $entityManager->flush();

     //retornem com a resposta el Json del usuario ja inserit
     $repository = $this->getDoctrine()->getRepository(Usuario::class);
     $usuario = $repository->find($usuario0->getId());
     $data = $usuario;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

    /**
    * PUT Route annotation.
    * @Put("/api/usuario/{id}")
    * @ParamConverter("usuario", converter="fos_rest.request_body")
    */
    public function modificarUsuario($id, Usuario $usuario)
    {
     $usuario0= $this->getDoctrine()
       ->getRepository(Usuario::class)
       ->find($id);
      //cal posar en la peticio el Header field:
      //Content-Type = application/json; charset=utf-8

      //cal instal·lar el SensioFrameworkExtraBundle
      //https://symfony.com/doc/master/bundles/FOSRestBundle/request_body_converter_listener.html


    //cerquem en la BDD la vehi$vehiculo enviada per Json
      // $vehiculo= $this->getDoctrine()
      //   ->getRepository(Vehiculo::class)
      //   ->find($usuario->getVehiculo());

    //modifiquem els diferents camps del usuario i persistim en la BDD
   
    $usuario0->setNombre($usuario->getNombre());
    $usuario0->setApellidos($usuario->getApellidos());
    $usuario0->setUsername($usuario->getUsername());
    $usuario0->setCorreo($usuario->getCorreo());
    $usuario0->setContrasena($usuario->getContrasena());
     //$usuario0->setVehiculo($vehiculo);

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($usuario0);
     $entityManager->flush();

    //retornem com a resposta el Json del usuario ja modificat
     $repository = $this->getDoctrine()->getRepository(Usuario::class);
     $usuario = $repository->find($id);
     $data = $usuario;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

/**
    * DELETE Route annotation.
    * @Delete("/api/usuario/{id}")
    */
    public function eliminarUsuario($id)
    {
     //cerquem en la BDD el usuario$usuario que hem d'eliminar
     $usuario= $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($id);

     //l'eliminem
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->remove($usuario);
     $entityManager->flush();

     //retornem com a resposta el Json del usuario$usuario esborrat
     $data = $usuario;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

} 


