<?php

namespace App\Controller\Admin\Company;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Company;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/administration")
 *
 * Class ExportCsvController
 * @package App\Controller\Admin\Company
 */
class ExportCsvController extends AbstractController
{
    /**
     * @Route("/companies-export-csv", name="companiesExport")
     */
    public function companiesExport()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository(Company::class)->findAll();

        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToFile('php://output', 'r+');

        $styleBold = (new StyleBuilder())
            ->setFontBold()
            ->build();

        $headersDate = [
            'Export du '. date("d-m-Y H:i:s"),
        ];

        $rowFromValues = WriterEntityFactory::createRowFromArray($headersDate, $styleBold);
        $writer->addRow($rowFromValues);

        $headers = [
            'Dénomination',
            'Mail',
            'Mail de contact',
            'Telephone',
            'Secteur d\'activité',
            'Détail de l\'activité',
            'Adresse',
            'Ville',
            'Pays',
            'Code Postal',
            'Secteur géographique d\'intervention',
            'Stratégie d\'engagement',
            'Informations Complémentaires'
        ];

        $rowFromValues = WriterEntityFactory::createRowFromArray($headers, $styleBold);
        $writer->addRow($rowFromValues);

        foreach ($companies as $company) {
            $rowFromValues = WriterEntityFactory::createRowFromArray($company->arrayExport());
            $writer->addRow($rowFromValues);
        }

        $writer->close();

        $response = new Response();

        $response->headers->set('Content-Type', 'application/xls');
        $response->headers->set('Content-Disposition','attachment; filename="export-entreprises.xlsx"');

        return $response;

    }

}