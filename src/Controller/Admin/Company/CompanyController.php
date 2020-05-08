<?php

namespace App\Controller\Admin\Company;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Company;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/administration/entreprises")
 *
 * Class CompanyController
 * @package App\Controller\Admin\Company
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/liste", name="admin_companyList")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository(Company::class)->findAll();

        return $this->render('admin/company/list.html.twig', [
            'companies' => $companies
        ]);
    }
    /**
     * @Route("/company-state/{id}", name="companyState")
     */
    public function companyState(Company $company)
    {
        $em = $this->getDoctrine()->getManager();

        $state = $company->getActivated();

        $company->setActivated(!$state);

        $em->persist($company);
        $em->flush();

        return $this->redirectToRoute('admin');
    }
}