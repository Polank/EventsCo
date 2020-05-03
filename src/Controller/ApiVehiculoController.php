<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\View\View;
use App\Entity\Vehiculo;
use App\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiVehiculoController extends FOSRestController
{
    
  /**
    * GET Route annotation.
    * @Get("/api/vehiculos", name="api_vehiculo")
    */
      public function getVehiculos()
    {
      $repository = $this->getDoctrine()->getRepository(Vehiculo::class);

      $data = $repository->findAll();

      $view = $this->view($data, 200);
      $view->setFormat('json');
      return $this->handleView($view);
    }

        
  /**
    * GET Route annotation.
    * @Get("/api/vehiculo/{id}")
    */
    public function getVehiculo($id)
    {
      $repository = $this->getDoctrine()->getRepository(Vehiculo::class);

      $data = $repository->find($id);

      $view = $this->view($data, 200);
      $view->setFormat('json');
      return $this->handleView($view);
    }

  /**
    * POST Route annotation.
    * @Post("/api/vehiculo")
    * @ParamConverter("vehiculo", converter="fos_rest.request_body")
    */
    public function insertarVehiculo(Vehiculo $vehiculo)
    {
    //cerquem en la BDD la vehiculo enviada per Json
     $usuario= $this->getDoctrine()
        ->getRepository(Usuario::class)
        ->find($vehiculo->getPropietario()->getId());

     //hem de crear un nou taller per persistir-lo a la BDD
     $vehiculo0 = new Vehiculo();
     $vehiculo0->setPropietario($usuario);
     $vehiculo0->setNumeroPlazas($vehiculo->getNumeroPlazas());
     $vehiculo0->setMatricula($vehiculo->getMatricula());
     $vehiculo0->setModelo($vehiculo->getModelo());

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($vehiculo0);
     $entityManager->flush();

     //retornem com a resposta el Json del taller ja inserit
     $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
     $vehiculo = $repository->find($vehiculo0->getId());
     $data = $vehiculo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

    /**
    * PUT Route annotation.
    * @Put("/api/vehiculo/{id}")
    * @ParamConverter("vehiculo", converter="fos_rest.request_body")
    */
    public function modificarVehiculo($id, Vehiculo $vehiculo)
    {
     $vehiculo0= $this->getDoctrine()
       ->getRepository(Vehiculo::class)
       ->find($id);
      //cal posar en la peticio el Header field:
      //Content-Type = application/json; charset=utf-8

      //cal instal·lar el SensioFrameworkExtraBundle
      //https://symfony.com/doc/master/bundles/FOSRestBundle/request_body_converter_listener.html


    //cerquem en la BDD la marca enviada per Json
    $usuario= $this->getDoctrine()
    ->getRepository(Usuario::class)
    ->find($vehiculo->getPropietario()->getId());

    //modifiquem els diferents camps del taller i persistim en la BDD
    $vehiculo0->setPropietario($usuario);
    $vehiculo0->setNumeroPlazas($vehiculo->getNumeroPlazas());
    $vehiculo0->setMatricula($vehiculo->getMatricula());
    $vehiculo0->setModelo($vehiculo->getModelo());

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($vehiculo0);
     $entityManager->flush();

    //retornem com a resposta el Json del taller ja modificat
     $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
     $vehiculo = $repository->find($id);
     $data = $vehiculo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
    

    /**
    * DELETE Route annotation.
    * @Delete("/api/vehiculo/{id}")
    */
    public function eliminarVehiculo($id)
    {
     //cerquem en la BDD el taller que hem d'eliminar
     $vehiculo= $this->getDoctrine()
        ->getRepository(Vehiculo::class)
        ->find($id);

     //l'eliminem
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->remove($vehiculo);
     $entityManager->flush();

     //retornem com a resposta el Json del taller esborrat
     $data = $vehiculo;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
}