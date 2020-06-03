<?php

namespace App\Controller;

use App\Entity\Admin\User;
use App\Form\CompanyType;
use App\Entity\Company;
use App\Form\CompanyRegistrationFormType;
use App\Form\CompanyUpdateRegistrationFormType;
use App\Notification\NotificationManager;
use App\Security\CompanyAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class CompanyController extends AbstractController
{

    /**
     * @var NotificationManager
     */
    private $notificationManager;

    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param CompanyAuthenticator $authenticator
     * @param integer|null $id Company's ID
     * @return Response
     *
     * @Route("/insrciption-entreprise/{id?}", name="company_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, CompanyAuthenticator $authenticator, $id = null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Redirige vers sa page entreprise s'il en a déjà un
        if(!is_null($this->getUser()->getCompany()) && is_null($id)){
            return $this->redirectToRoute('companyPageView', array('name' => $this->getUser()->getCompany()->getName()));
        }elseif($id){
            $company = $entityManager->getRepository(Company::class)->find($id);
            $form = $this->createForm(CompanyUpdateRegistrationFormType::class, $company);
        }else{
            $company = new Company();
            $form = $this->createForm(CompanyRegistrationFormType::class, $company);
        }

        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!is_null($id))
                $company->setOwner($this->getUser());
            
            $entityManager->persist($company);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // return $guardHandler->authenticateUserAndHandleSuccess(
            //     $company,
            //     $request,
            //     $authenticator,
            //     'main' // firewall name in security.yaml
            // );
            /** @var User $user */
            $user = $this->getUser();
            $this->notificationManager->notifyRegistrationCompanyPage($user);

            return $this->redirectToRoute('companyPageView', array('name' => $company->getName()));
        }

        return $this->render('registration/company.register.html.twig', [
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

        return $this->json($companies, Response::HTTP_OK, [], [
            'groups' => ['json']
        ]);
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
