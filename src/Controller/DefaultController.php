<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Extremoduro;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ExtremoduroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DefaultController extends AbstractController
{
    
    #[Route("/" , name:"home")]
    public function getHome()
    {          
      

        return $this->render("extremoduro/baseExtremoduro.html.twig");
    }


    /*FUNCION QUE PINTA EL LISTADO DE ALBUMS*/ 
    #[Route("/albums", name:"getAlbums")]
    public function getAlbums(EntityManagerInterface $doctrine)
    {          
        $repository=$doctrine->getRepository(Extremoduro::class);
        $albums= $repository->findAll(); 

        return $this->render("extremoduro/listExtremoduro.html.twig",  ["albums" => $albums]);
    }

    /*FUNCION QUE PINTA EL DETALLE DEL ALBUM*/ 
    #[Route("/album/{id}", name:"showAlbum")]
    public function getAlbum($id, EntityManagerInterface $doctrine)
    {
        $repository=$doctrine->getRepository(Extremoduro::class);
            $album= $repository->find($id);

        return $this->render("extremoduro/showAlbums.html.twig", ["album" => $album]);
    }



    #[Route("/new/album", name:"newAlbum")]
    public function newAlbum(Request $request, EntityManagerInterface $doctrine){
     
        $form=$this->createForm(ExtremoduroType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $album = $form->getData();
            $doctrine->persist($album);
            $doctrine->flush();
            $this->addFlash('success','Insertado correctamente');
            return $this->redirectToRoute('getAlbums');
            
        }
        return $this->renderForm("extremoduro/newAlbum.html.twig",['AlbumForm'=> $form]);
      
    }
    #[Route("/edit/album/{id}", name:"editAlbum")]
    public function editAlbum(Request $request, EntityManagerInterface $doctrine, $id){
        
        $repository = $doctrine->getRepository(Extremoduro::class);
        $album = $repository->find($id);

        $form=$this->createForm(ExtremoduroType::class, $album);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $album = $form->getData();
            $doctrine->persist($album);
            $doctrine->flush();
            $this->addFlash('success','Insertado correctamente');
            return $this->redirectToRoute('getAlbums');
            
        }
        return $this->renderForm("extremoduro/newAlbum.html.twig",['AlbumForm'=> $form]);
    
    }

    #[Route("/delete/album/{id}", name:"deleteAlbum")]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteAlbum( EntityManagerInterface $doctrine, $id){
        
        $repository = $doctrine->getRepository(Extremoduro::class);
        $album = $repository->find($id);
        
        $doctrine->remove($album);
            $doctrine->flush();
            $this->addFlash('success','Borrado correctamente');
            return $this->redirectToRoute('getAlbums');
            
        
        
    
}
}