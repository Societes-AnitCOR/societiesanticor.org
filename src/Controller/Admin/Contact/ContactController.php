<?php

namespace App\Controller\Admin\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Contact;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/administration")
 *
 * Class CompanyController
 * @package App\Controller\Admin\Contact
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="mail")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository(Contact::class)->findAll();
        return $this->render('admin/contact/contact.html.twig', [
            'contacts' => $contacts
        ]);
    }

}