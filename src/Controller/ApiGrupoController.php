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
use App\Entity\Grupo;
use App\Entity\Vehiculo;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ApiGrupoController extends FOSRestController
{

/**
* GET Route annotation.
* @Get("/api/grupos")
*/
public function getGrupos()
{
  $repository = $this->getDoctrine()->getRepository(Grupo::class);

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
* @Get("/api/grupo/{id}")
*/
public function getGrupo($id) 
{
  $repository = $this->getDoctrine()->getRepository(Grupo::class);
  $grupo = $repository->find($id);

  $view = $this->view($grupo, 200);
  $view->setFormat('json');
  return $this->handleView($view);
}

/**
    * POST Route annotation.
    * @Post("/api/grupo")
    * @ParamConverter("grupo", converter="fos_rest.request_body")
    */
    public function insertargrupo(Grupo $grupo)
    {
     //cerquem en la BDD la Usuario enviada per Json
     $usuario= $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($grupo->getAdmin()->getId());

     //hem de crear un nou grupo per persistir-lo a la BDD
     $grupo0 = new grupo();
     $grupo0->setNombre($grupo->getNombre());
     $grupo0->setAdmin($usuario);


     //$grupo0->setUsuario($Usuario);

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($grupo0);
     $entityManager->flush();

     //retornem com a resposta el Json del grupo ja inserit
     $repository = $this->getDoctrine()->getRepository(Grupo::class);
     $grupo = $repository->find($grupo0->getId());
     $data = $grupo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

    /**
    * PUT Route annotation.
    * @Put("/api/grupo/{id}")
    * @ParamConverter("grupo", converter="fos_rest.request_body")
    */
    public function modificarGrupo($id, Grupo $grupo)
    {

        $grupo0= $this->getDoctrine()
       ->getRepository(Grupo::class)
       ->find($id);
     //cerquem en la BDD la Usuario enviada per Json
     $usuario= $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($grupo->getAdmin()->getId());

    //modifiquem els diferents camps del taller i persistim en la BDD
     
     $grupo0->setNombre($grupo->getNombre());
     $grupo0->setAdmin($usuario);

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($grupo0);
     $entityManager->flush();

     //retornem com a resposta el Json del grupo ja inserit
     $repository = $this->getDoctrine()->getRepository(Grupo::class);
     $grupo = $repository->find($grupo0->getId());
     $data = $grupo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

/**
    * DELETE Route annotation.
    * @Delete("/api/grupo/{id}")
    */
    public function eliminarGrupo($id)
    {
     //cerquem en la BDD el taller que hem d'eliminar
     $grupo= $this->getDoctrine()
        ->getRepository(Grupo::class)
        ->find($id);

     //l'eliminem
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->remove($grupo);
     $entityManager->flush();

     //retornem com a resposta el Json del taller esborrat
     $data = $grupo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
} 