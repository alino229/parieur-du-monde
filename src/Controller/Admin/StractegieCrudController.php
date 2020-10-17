<?php

namespace App\Controller\Admin;

use App\Entity\Stractegie;
use App\Form\StractegieType;
use App\Repository\StractegieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/stractegie")
 */
class StractegieCrudController extends AbstractController
{
    /**
     * @Route("/", name="stractegie_index", methods={"GET"})
     * @param StractegieRepository $stractegieRepository
     * @return Response
     */
    public function index(StractegieRepository $stractegieRepository): Response
    {
        return $this->render('admin/stractegie/index.html.twig', [
            'stractegies' => $stractegieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stractegie_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $stractegie = new Stractegie();
        $form = $this->createForm(StractegieType::class, $stractegie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stractegie);
            $entityManager->flush();

            return $this->redirectToRoute('stractegie_index');
        }

        return $this->render('admin/stractegie/new.html.twig', [
            'stractegie' => $stractegie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stractegie_show", methods={"GET"})
     * @param Stractegie $stractegie
     * @return Response
     */
    public function show(Stractegie $stractegie): Response
    {
        return $this->render('admin/stractegie/show.html.twig', [
            'stractegie' => $stractegie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stractegie_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Stractegie $stractegie
     * @return Response
     */
    public function edit(Request $request, Stractegie $stractegie): Response
    {
        $form = $this->createForm(StractegieType::class, $stractegie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stractegie_index');
        }

        return $this->render('admin/stractegie/edit.html.twig', [
            'stractegie' => $stractegie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stractegie_delete", methods={"DELETE"})
     * @param Request $request
     * @param Stractegie $stractegie
     * @return Response
     */
    public function delete(Request $request, Stractegie $stractegie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stractegie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stractegie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stractegie_index');
    }
}
