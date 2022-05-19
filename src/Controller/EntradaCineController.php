<?php

namespace App\Controller;

use App\Form\FilterCategoryEntradaCineFormType;
use App\Form\EntradaCineFormType;
use App\Form\EntradaCineType;
use App\Entity\EntradaCine;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntradaCineController extends AbstractController{
    #[Route('nuevaEntradaCine', name: 'nuevaEntradaCine')]
    public function newEntrada(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EntradaCineType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entrada = $form->getData();
            $user = $this->getUser();
            $user->addEntradasCine($entrada);
            $em->persist($entrada);
            $em->flush();
            return $this->redirectToRoute('misEntradas');
        }
        return $this->renderForm('/entradas/createentrada.html.twig', ['entradaForm'=>$form]); 
    }

    #[Route('misEntradas', name: 'misEntradas')]
    public function listEntradas(EntityManagerInterface $em){
        $user = $this->getUser();
        $entradas = $user->getEntradasCine();
        return $this->render('./entradas/misentradas.html.twig', ['entradas'=>$entradas]);
    }
}