<?php

namespace App\Controller;

use App\Form\CompanyType;
use App\Entity\Company;
use App\Form\CompanyRegistrationFormType;
use App\Security\CompanyAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompanyController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param CompanyAuthenticator $authenticator
     * @return Response
     *
     * @Route("/insrciption-entreprise", name="company_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, CompanyAuthenticator $authenticator): Response
    {
        $user = new Company();
        $form = $this->createForm(CompanyRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/companyRegister.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entreprises-json", name="companiesJSON")
     */
    public function companiesJSON()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository(Company::class)->findAll();

        return new JsonResponse($companies);
    }

    /**
     * @Route("/entreprises-engagees", name="companies")
     */
    public function companies()
    {
        return $this->render('main/companies.html.twig');
    }

    /**
     * @Route("/espace-entreprise", name="companyPage")
     */
    public function companyPage()
    {
        return $this->render('main/companyPage.html.twig', [
        ]);
    }

    /**
     * @Route("/espace-entreprise/{name}", name="companyPageView")
     */
    public function companyPageView($name)
    {
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository(Company::class)->findOneByName($name);

        return $this->render('main/companyPageView.html.twig', [
            'company' => $company
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/modifier-entreprise", name="companyUpdate")
     */
    public function companyUpdate(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(CompanyType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('logo')->getData();

            if($image != null) {
                $imageName = 'logo-'.uniqid().'.'.$image->guessExtension();

                $image->move(
                    $this->getParameter('logos_folder'),
                    $imageName
                );

                $user->setLogo($imageName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('companyPage');
        }

        return $this->render('main/companyUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
