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
use App\Entity\Actividad;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiActividadController extends FOSRestController
{
     

    /**
    * GET Route annotation.
    * @Get("/api/actividad")
    */
    public function getActividades()
    {
     $repository = $this->getDoctrine()->getRepository(Actividad::class);

     $data = $repository->findAll();

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
 /**
    * GET Route annotation.
    * @Get("/api/actividad/{id}")
    */
    public function getActividad($id)
    {
     $actividad= $this->getDoctrine()
      ->getRepository(Actividad::class)
      ->find($id);

     $data = $actividad;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }

   /**
    * POST Route annotation.
    * @Post("/api/actividad")
    * @ParamConverter("actividad", converter="fos_rest.request_body")
    */
    public function insertActividad(Actividad $actividad)
    {
     //hem de crear un nou taller per persistir-lo a la BDD
     $actividad0 = new Actividad();
     $actividad0->setPrecio($actividad->getPrecio());
     $actividad0->setLocalizacion($actividad->getLocalizacion());
     $actividad0->setNombre($actividad->getNombre());
     $actividad0->setDescripcion($actividad->getDescripcion());
     

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($actividad0);
     $entityManager->flush();

     //retornem com a resposta el Json del taller ja inserit
     $repository = $this->getDoctrine()->getRepository(Actividad::class);
     $actividad = $repository->find($actividad0->getId());
     $data = $actividad;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
 /**
    * PUT Route annotation.
    * @Put("/api/actividad/{id}")
    * @ParamConverter("actividad", converter="fos_rest.request_body")
    */
    public function modificarActividad($id, Actividad $actividad)
    {
     $actividad0= $this->getDoctrine()
       ->getRepository(Actividad::class)
       ->find($id);
    

    $actividad0->setPrecio($actividad->getPrecio());
     $actividad0->setLocalizacion($actividad->getLocalizacion());
     $actividad0->setNombre($actividad->getNombre());
     $actividad0->setDescripcion($actividad->getDescripcion());
     
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($actividad0);
     $entityManager->flush();

     //retornem com a resposta el Json del taller ja inserit
     $repository = $this->getDoctrine()->getRepository(Actividad::class);
     $actividad = $repository->find($actividad0->getId());
     $data = $actividad;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
  /**
    * DELETE Route annotation.
    * @Delete("/api/actividad/{id}")
    */
    public function eliminarActividad($id)
    {
     $actividad= $this->getDoctrine()
        ->getRepository(Actividad::class)
        ->find($id);

     //l'eliminem
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->remove($actividad);
     $entityManager->flush();

     //retornem com a resposta el Json del taller esborrat
     $data = $actividad;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
}