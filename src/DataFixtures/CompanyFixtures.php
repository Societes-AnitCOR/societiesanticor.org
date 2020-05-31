<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Symfony\Component\Console\Output\ConsoleOutput;

use App\DataFixtures\Referentiels;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return array(
            Referentiels::class,    
        );
    }

    public function load(ObjectManager $em)
    {

        $output = new ConsoleOutput();

        /*
            Data generated avec : `outils/get_companies_json.html`
        */
        $companies_data = array (
            0 => 
            array (
              '_id' => '1',
              'branchName' => 'Industrie - Matériaux',
              'name' => 'Lauak',
              'telephone' => '',
              'logo' => 'auto_1.png',
              '_logo' => 'https://www.groupe-lauak.com/wp-content/uploads/2019/06/logo-lauak-aerostructures-france-2.png',
              'contribution' => 'Don de blouses TTS et combinaisons de peinture à une clinique locale',
              'description' => 'Fabrication de structures métalliques et de parties de structures',
              'geographicPerimeter' => '64240',
              'address' => 'RTE DE CAMBO
          64240 HASPARREN',
              'postalCode' => '64240',
              'city' => 'Hasparren',
              'geolat' => '43,3829226',
              'geolong' => '-1,3243506',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'http://www.groupe-lauak.com',
              'keywords' => 'Combinaison de protection',
              'complementaryInformations' => 'La société LAUAK INDUSTRIE est spécialisée dans les travaux de chaudronnerie aluminium et de métaux durs, la tôlerie industrielle, l\'usinage de pièces métalliques, l\'usinage de précision, l\'assemblage par soudage, l\'assemblage de structures métalliques pour les industries aéronautiques.',
              '_kompass_id' => 'FR8137819',
            ),
            1 => 
            array (
              '_id' => '2',
              'branchName' => 'Soins - Esthétique - Coiffure - Entretien',
              'name' => 'Pierre Fabre',
              'telephone' => '',
              'logo' => 'auto_2.jpg',
              '_logo' => 'https://www.lsa-conso.fr/mediatheque/5/1/7/000005715_87.jpg',
              'contribution' => 'Production des gels hydroalcooliques à destination des pharmacies d’officine',
              'description' => 'Fabrication de parfums et de produits pour la toilette',
              'geographicPerimeter' => '81580',
              'address' => 'Route de Cambounet sur Sor, 81580 Soual',
              'postalCode' => '81580',
              'city' => 'Soual',
              'geolat' => '43,56796',
              'geolong' => '2,124894',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'http://www.pierre-fabre.com',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Société spécialisée dans le domaine de la fabrication des produits cosmétiques avec la production des médicaments éthiques aux soins dermo-cosmétiques passant par la santé grand public, les soins de beauté de la peau, du cuir chevelu, des cheveux...',
              '_kompass_id' => 'FR1976018',
            ),
            2 => 
            array (
              '_id' => '3',
              'branchName' => 'Industrie - Matériaux',
              'name' => 'PRP Création',
              'telephone' => '',
              'logo' => 'auto_3.png',
              '_logo' => 'https://www.prpcreation.com/wp-content/themes/PRP/assets/img/logo.png',
              'contribution' => 'Production de flacons de gel hydroalcoolique (production x4 en 1 semaine)',
              'description' => 'Fabrication d\'emballages en matières plastiques',
              'geographicPerimeter' => '1100',
              'address' => '247 RUE DE CHAMBOURG
          PLASTICS VALLEE VEYZIAT
          01100 OYONNAX',
              'postalCode' => '1100',
              'city' => 'Oyonnax',
              'geolat' => '46,2678148',
              'geolong' => '5,6069865',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'http://www.prpcreation.com',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Implantée à Oyonnax, la société est spécialisée dans le domaine de la fabrication de flacons pour parfumerie, cosmétique et pharmacie. La société propose ses services pour l\'injection soufflage par bi-orientation,  injection pour le bouchage, parachèvement...',
              '_kompass_id' => 'FR1913559',
            ),
            3 => 
            array (
              '_id' => '4',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Pernod Ricard',
              'telephone' => '',
              'logo' => 'auto_4.png',
              '_logo' => 'https://www.cafa-formations.com/wp-content/uploads/2019/04/pernod-ricard-paint.png',
              'contribution' => 'don au laboratoire Cooper de 70000 litres d’alcool pour fabriquer environ 1,8 million de flacons individuels de 50 ml de gel hydroalcoolique.',
              'description' => 'Commercialisation et distribution de vins et spiritueux',
              'geographicPerimeter' => '75116',
              'address' => '12 PL DES ETATS UNIS
          75116 PARIS 16',
              'postalCode' => '75116',
              'city' => 'PARIS',
              'geolat' => '48,8683424',
              'geolong' => '2,2940278',
              'country' => 'France, Suède, Irlande, Espagne, Etats-Unis',
              'email' => '',
              'urlWebsite' => 'https://www.pernod-ricard.com',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'PERNOD RICARD située dans la ville de PARIS 16 est un établissement co-leader mondial du secteur des Vins & Spiritueux : production et la commercialisation de vins rouges, vins blancs, vins rosés, vins effervescents, spiritueux, carménère que ce soit pour les particuliers ou les professionnels.',
              '_kompass_id' => 'FR8000539',
            ),
            4 => 
            array (
              '_id' => '5',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Tereos (Béghin-Say) -  Artenay',
              'telephone' => '',
              'logo' => 'auto_5.png',
              '_logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Logo_Tereos_2016.png',
              'contribution' => 'Production de 11000l/semaine (groupe Tereos entier) de gels hydroalcooliques pour les Agences régionales de santé et les hôpitaux des régions proches',
              'description' => 'Fabrication de sucre',
              'geographicPerimeter' => '45410',
              'address' => 'RTE DE PARIS 4510 ARTENAY',
              'postalCode' => '45410',
              'city' => 'Artenay',
              'geolat' => '48,0912703',
              'geolong' => '1,8865095',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://tereos.com/fr/',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Groupe coopératif sucrier, Tereos transforme des matières premières agricoles en sucre, en alcool et en amidon.',
              '_kompass_id' => '-',
            ),
            5 => 
            array (
              '_id' => '6',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Tereos (Béghin-Say) - Origny-Sainte-Benoite',
              'telephone' => '',
              'logo' => 'auto_6.png',
              '_logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Logo_Tereos_2016.png',
              'contribution' => 'Production de 11000l/semaine (groupe Tereos entier) de gels hydroalcooliques pour les Agences régionales de santé et les hôpitaux des régions proches',
              'description' => 'Fabrication de sucre',
              'geographicPerimeter' => '2390',
              'address' => '11 RUE PASTEUR 02390 ORIGNY-SAINTE-BENOITE',
              'postalCode' => '2390',
              'city' => 'Origny-Sainte-Benoite',
              'geolat' => '49,8396748',
              'geolong' => '3,4801111',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://tereos.com/fr/',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Groupe coopératif sucrier, Tereos transforme des matières premières agricoles en sucre, en alcool et en amidon.',
              '_kompass_id' => '-',
            ),
            6 => 
            array (
              '_id' => '7',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Tereos (Béghin-Say) - Lillers',
              'telephone' => '',
              'logo' => 'auto_7.png',
              '_logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Logo_Tereos_2016.png',
              'contribution' => 'Production de 11000l/semaine (groupe Tereos entier) de gels hydroalcooliques pour les Agences régionales de santé et les hôpitaux des régions proches',
              'description' => 'Fabrication de sucre',
              'geographicPerimeter' => '62190',
              'address' => '100 RUE DE VERDUN 62190 LILLERS',
              'postalCode' => '62190',
              'city' => 'Lillers',
              'geolat' => '50,5599997',
              'geolong' => '2,4945826',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://tereos.com/fr/',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Groupe coopératif sucrier, Tereos transforme des matières premières agricoles en sucre, en alcool et en amidon.',
              '_kompass_id' => '-',
            ),
            7 => 
            array (
              '_id' => '8',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Tereos (Béghin-Say) - Val-des-Marais',
              'telephone' => '',
              'logo' => 'auto_8.png',
              '_logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Logo_Tereos_2016.png',
              'contribution' => 'Production de 11000l/semaine (groupe Tereos entier) de gels hydroalcooliques pour les Agences régionales de santé et les hôpitaux des régions proches',
              'description' => 'Fabrication de sucre',
              'geographicPerimeter' => '51130',
              'address' => '27 Rue du Tuilet, 51130 Val-des-Marais',
              'postalCode' => '51130',
              'city' => 'Val-des-Marais',
              'geolat' => '48,8160478',
              'geolong' => '3,980795',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://tereos.com/fr/',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Groupe coopératif sucrier, Tereos transforme des matières premières agricoles en sucre, en alcool et en amidon.',
              '_kompass_id' => '-',
            ),
            8 => 
            array (
              '_id' => '9',
              'branchName' => 'Agroalimentaire - Alimentation',
              'name' => 'Tereos (Béghin-Say) - Mesnil-Saint-Nicaise',
              'telephone' => '',
              'logo' => 'auto_9.png',
              '_logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/98/Logo_Tereos_2016.png',
              'contribution' => 'Production de 11000l/semaine (groupe Tereos entier) de gels hydroalcooliques pour les Agences régionales de santé et les hôpitaux des régions proches',
              'description' => 'Fabrication de sucre',
              'geographicPerimeter' => '80190',
              'address' => '46 Rue de Nesle, 80190 Mesnil-Saint-Nicaise',
              'postalCode' => '80190',
              'city' => 'Mesnil-Saint-Nicaise',
              'geolat' => '49,7689481',
              'geolong' => '2,9088051',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://tereos.com/fr/',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Groupe coopératif sucrier, Tereos transforme des matières premières agricoles en sucre, en alcool et en amidon.',
              '_kompass_id' => '-',
            ),
            9 => 
            array (
              '_id' => '10',
              'branchName' => 'Soins - Esthétique - Coiffure - Entretien',
              'name' => 'LVMH (Dior Saint Jean de Braye)',
              'telephone' => '',
              'logo' => 'auto_10.png',
              '_logo' => 'https://www.frayssinet-joaillier.fr/wp-content/uploads/2018/11/logo-Dior.png',
              'contribution' => 'Livraison à l’AP-HP à partir du 17/03/20',
              'description' => 'Fabrication de parfums et de produits pour la toilette',
              'geographicPerimeter' => '45800',
              'address' => '185 Avenue de Verdun, 45800 Saint-Jean-de-Braye',
              'postalCode' => '45800',
              'city' => 'Saint Jean de Braye',
              'geolat' => '47,9265941',
              'geolong' => '1,9894396',
              'country' => 'France',
              'email' => '',
              'urlWebsite' => 'https://www.dior.com/fr_fr',
              'keywords' => 'Gel hydroalcoolique',
              'complementaryInformations' => 'Etablissement spécialisé dans la fabrication, la conception, la commercialisation et l\'exportation des produits cosmétiques que ce soit pour les femmes et pour les hommes : crème pour la peau, produits pour le soin de visage et du corps, eau de parfum, eau de toilette....',
              '_kompass_id' => 'FR1930451',
            ),
        );

        // Insert Companies
        $output->write("\tInserting companies\n");
        
        foreach ($companies_data as $company_data)
        {
            $company = new Company();

            $branch = $em->getRepository(Branch::class)->findOneByName($company_data['branchName']);

            $company->setName (  $company_data['name']  );
            $company->setEmail (  $company_data['email']  );
            $company->setTelephone (  $company_data['telephone']  );
            $company->setLogo (  $company_data['logo']  );
            $company->setBranch (  $branch  );
            $company->setContribution (  $company_data['contribution']  );
            $company->setAddress (  $company_data['address']  );
            $company->setCity (  $company_data['city']  );
            $company->setCountry (  $company_data['country']  );
            $company->setPostalCode (  $company_data['postalCode']  );
            $company->setGeographicPerimeter (  $company_data['geographicPerimeter']  );
            $company->setDescription (  $company_data['description']  );
            $company->setComplementaryInformations (  $company_data['complementaryInformations']  );
            $company->setUrlWebsite (  $company_data['urlWebsite']  );
            $company->setKeywords (  $company_data['keywords']  );

            $em->persist($company);

        }
        $em->flush();

        $output->write("\tDownloading company logos...\n");
        foreach ($companies_data as $company_data)
        {
            
            try {
                $content = file_get_contents($company_data['_logo']);
                file_put_contents("public/uploads/companies/logos/" . $company_data['logo'], $content);
                continue;
            } catch (Exception $e) {

            }
            $output->write("\t !! Failed to download image for :" .  $company_data['name'] . " : "  . $company_data['_logo'] . "\n");
        }
        
    }
}
