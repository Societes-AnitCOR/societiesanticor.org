<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $em)
    {
        $user = new User();
        $user->setEmail('support@initiative.fr');
        $user->setUsername('support@initiative.fr');

        $password = $this->encoder->encodePassword($user, 's0l1d41r3-1n1t14t1v3');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

        $em->persist($user);

        $branchNames = [
            'Agriculture',
            'Agroalimentaire - Alimentation',
            'Animaux',
            'Architecture - Aménagement intérieur',
            'Artisanat - Métiers d\'art',
            'Banque - Finance - Assurance',
            'Bâtiment - Travaux publics',
            'Biologie - Chimie',
            'Commerce - Immobilier',
            'Communication - Information',
            'Culture - Spectacle',
            'Défense - Sécurité - Secours',
            'Droit',
            'Edition - Imprimerie - Livre',
            'Informatique - électronique',
            'Enseignement - Formation',
            'Environnement - Nature - Nettoyage',
            'Gestion - Audit - Ressources humaines',
            'Hôtellerie - Restauration - Tourisme',
            'Humanitaire',
            'Industrie - Matériaux',
            'Lettres - Sciences humaines',
            'Mécanique - Maintenance',
            'Numérique - Multimédia - Audiovisuel',
            'Santé',
            'Sciences - Maths - Physique',
            'Secrétariat - Accueil',
            'Social - Services à la personne',
            'Soins - Esthétique - Coiffure',
            'Sport et animation',
            'Transport - Logistique',
            'Autres secteurs'
        ];

        foreach ($branchNames as $branchName){
            $branch = new Branch();
            $branch->setName($branchName);
            $em->persist($branch);
        }
        $em->flush();
        
    }
}
