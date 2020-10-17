<?php

namespace App\Controller\Admin;

use App\Entity\Vip;
use App\Form\VipType;
use App\Repository\VipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/vip")
 */
class VipCrudController extends AbstractController
{
    /**
     * @Route("/", name="vip_index", methods={"GET"})
     */
    public function index(VipRepository $vipRepository): Response
    {
        return $this->render('admin/vip/index.html.twig', [
            'vips' => $vipRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vip_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vip = new Vip();
        $form = $this->createForm(VipType::class, $vip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vip);
            $entityManager->flush();

            return $this->redirectToRoute('vip_index');
        }

        return $this->render('admin/vip/new.html.twig', [
            'vip' => $vip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vip_show", methods={"GET"})
     */
    public function show(Vip $vip): Response
    {
        return $this->render('admin/vip/show.html.twig', [
            'vip' => $vip,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vip_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vip $vip): Response
    {
        $form = $this->createForm(VipType::class, $vip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vip_index');
        }

        return $this->render('vip/edit.html.twig', [
            'vip' => $vip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vip_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vip $vip): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vip->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vip_index');
    }
}
