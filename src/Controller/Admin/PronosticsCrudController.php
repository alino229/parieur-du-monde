<?php

namespace App\Controller\Admin;

use App\Entity\Pronostics;
use App\Form\PronosticsType;
use App\Repository\PronosticsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/pronostics")
 */
class PronosticsCrudController extends AbstractController
{
    /**
     * @Route("/", name="pronostics_index", methods={"GET"})
     * @param PronosticsRepository $pronosticsRepository
     * @return Response
     */
    public function index(PronosticsRepository $pronosticsRepository): Response
    {
        return $this->render('admin/pronostics/index.html.twig', [
            'pronostics' => $pronosticsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pronostics_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $pronostic = new Pronostics();
        $form = $this->createForm(PronosticsType::class, $pronostic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $pronostic->setAddDate(new \DateTime('now'));
            $entityManager->persist($pronostic);
            $entityManager->flush();

            return $this->redirectToRoute('pronostics_index');
        }

        return $this->render('admin/pronostics/new.html.twig', [
            'pronostic' => $pronostic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/afficher", name="pronostics_show", methods={"GET"})
     * @param Pronostics $pronostic
     * @return Response
     */
    public function show(Pronostics $pronostic): Response
    {
        return $this->render('admin/pronostics/show.html.twig', [
            'pronostic' => $pronostic,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="pronostics_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Pronostics $pronostic
     * @return Response
     */
    public function edit(Request $request, Pronostics $pronostic): Response
    {
        $form = $this->createForm(PronosticsType::class, $pronostic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pronostics_index');
        }

        return $this->render('admin/pronostics/edit.html.twig', [
            'pronostic' => $pronostic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/effacer", name="pronostics_delete", methods={"DELETE"})
     * @param Request $request
     * @param Pronostics $pronostic
     * @return Response
     */
    public function delete(Request $request, Pronostics $pronostic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pronostic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pronostic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pronostics_index');
    }
}
