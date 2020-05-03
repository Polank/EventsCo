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
use App\Entity\Evento;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiEventoController extends FOSRestController
{
     

    /**
    * GET Route annotation.
    * @Get("/api/evento")
    */
    public function getEventos()
    {
     $repository = $this->getDoctrine()->getRepository(Evento::class);

     $data = $repository->findAll();

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
/**
    * GET Route annotation.
    * @Get("/api/evento/{id}")
    */
    public function getEvento($id)
    {
     $evento= $this->getDoctrine()
      ->getRepository(Evento::class)
      ->find($id);

     $data = $evento;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }


   /**
    * POST Route annotation.
    * @Post("/api/evento")
    * @ParamConverter("evento", converter="fos_rest.request_body")
    */
    public function insertEvento(Evento $evento)
    {
     //hem de crear un nou taller per persistir-lo a la BDD
     $evento0 = new Evento();
     $evento0->setCategoria($evento->getCategoria());
     $evento0->setFecha($evento->getFecha());
     $evento0->setNombre($evento->getNombre());
     $evento0->setPrecioTotal($evento->getPrecioTotal());
     $evento0->setDescripcion($evento->getDescripcion());
     $evento0->addActividad($evento->getActividades());
     
     

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($evento0);
     $entityManager->flush();

     //retornem com a resposta el Json del taller ja inserit
     $repository = $this->getDoctrine()->getRepository(Evento::class);
     $evento = $repository->find($evento0->getId());
     $data = $evento;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
 /**
    * PUT Route annotation.
    * @Put("/api/evento/{id}")
    * @ParamConverter("evento", converter="fos_rest.request_body")
    */
    public function modificarEvento($id, Evento $evento)
    {
     $evento0= $this->getDoctrine()
       ->getRepository(Evento::class)
       ->find($id);
    

       $evento0->setCategoria($evento->getCategoria());
       $evento0->setFecha($evento->getFecha());
       $evento0->setNombre($evento->getNombre());
       $evento0->setPrecioTotal($evento->getPrecioTotal());
       $evento0->setDescripcion($evento->getDescripcion());

     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->persist($evento0);
     $entityManager->flush();

     //retornem com a resposta el Json del taller ja inserit
     $repository = $this->getDoctrine()->getRepository(Evento::class);
     $evento = $repository->find($evento0->getId());
     $data = $evento;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
  /**
    * DELETE Route annotation.
    * @Delete("/api/evento/{id}")
    */
    public function eliminarEvento($id)
    {
     $evento= $this->getDoctrine()
        ->getRepository(Evento::class)
        ->find($id);

     //l'eliminem
     $entityManager = $this->getDoctrine()->getManager();
     $entityManager->remove($evento);
     $entityManager->flush();

     //retornem com a resposta el Json del taller esborrat
     $data = $evento;

     $view = $this->view($data, 200);
     $view->setFormat('json');
     return $this->handleView($view);
    }
}