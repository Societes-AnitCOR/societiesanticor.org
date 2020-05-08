<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/administration")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @return Response
     */
    public function navbar()
    {
        $user = $this->getUser();
        return $this->render('admin/_components/navbar.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * @return Response
     */
    public function menu()
    {
        $user = $this->getUser();
        return $this->render('admin/_components/menu.html.twig', array(
            'user' => $user
        ));
    }
}
