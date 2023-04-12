<?php

namespace App\Controller;

use App\Entity\Destinations;
use App\Form\Type\destinationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DestinationsController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/destinations', name: 'indexdestination')]
    public function index(): Response
    {
        $destinations = $this->em->getRepository(Destinations::class)->findAll();
        return $this->render('destinations/index.html.twig', [
            'Destinations' => $destinations
        ]);
    }
    #[Route('/destinations/show/{id}', name: 'detailsdestination')]
    public function details($id): Response
    {
        $destination = $this->em->getRepository(Destinations::class)->find($id);

        // Foreign-Key call getter from Controller
        $status = $destination->getFkStatus();

        return $this->render('destinations/show.html.twig', [
            'Destination' => $destination,
            'Status' => $status
        ]);
    }

    #[Route('/destinations/create', name: 'createdestination')]
    public function CreateAction(request $request): Response
    {
        $destination = new Destinations();
        $form = $this->createForm(destinationType::class, $destination);
        $destination = $form->getData();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $this->em->persist($destination);
            $this->em->flush();

            return $this->redirectToRoute('createdestination');
        }
        return $this->render('destinations/create.html.twig', array(
            'form' => $form,
        ));
    }

    #[Route('/destinations/edit/{id}', name: 'editdestination')]
    public function editAction(request $request, int $id): Response
    {
        $destination = $this->em->getRepository(Destinations::class)->find($id);

        if (!$destination) {
            throw $this->createNotFoundException(
                'No Destination found for id ' . $id
            );
        }

        $form = $this->createForm(destinationType::class, $destination);
        $destination = $form->getData();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($destination);
            $this->em->flush();

            return $this->redirectToRoute('createdestination');
        }
        return $this->render('destinations/edit.html.twig', array(
            'form' => $form,
        ));
    }
    #[Route('/destinations/delete/{id}', name: 'deletedestination')]
    public function deleteAction($id): Response
    {
        $destination = $this->em->getRepository(Destinations::class)->find($id);

        $this->em->remove($destination);
        $this->em->flush();
        return $this->redirectToRoute('indexdestination');
    }
}
