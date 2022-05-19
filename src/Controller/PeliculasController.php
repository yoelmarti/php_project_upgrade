<?php

namespace App\Controller;

use App\Form\FilterCategoryPeliculasFormType;

use App\Form\PeliculasFormType;

use App\Form\PeliculasType;

use App\Entity\Peliculas;



use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PeliculasController extends AbstractController
{
    #[Route('add_peliculas', name: 'add_peliculas')]
    public function newPelicula(Request $request, EntityManagerInterface $em){

        $form = $this->createForm(PeliculasType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $pelicula = $form->getData();
            $user = $this->getUser();
            $user->addPelicula($pelicula);
            $em->persist($pelicula);
            $em->flush();
            return $this->redirectToRoute('peliculas');
        }
        return $this->renderForm('/peliculas/addPelicula.html.twig', ['peliculaForm'=>$form]);
    }
    
    
    #[Route('peliculas', name: 'peliculas')]
    public function listPeliculas(EntityManagerInterface $em)
    {
        
        $user = $this->getUser();
        $peliculas = $user->getPeliculas();
        return $this->render('./peliculas/peliculas.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }
}
