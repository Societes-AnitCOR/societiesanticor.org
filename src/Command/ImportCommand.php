<?php

namespace App\Command;

use App\Entity\Branch;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    private $em;
    private $tab = 0;
    /** @var bool */
    private $debug = false;
    /** @var Logger|null */
    protected $logger;
    /** @var bool */
    private $is_inited = false;
    /** @var string|null */
    private $proc_name;
    /** @var OutputInterface|null */
    private $output;

    /**
     * @return EntityManager|object
     */
    protected function getEntityManager()
    {
        return $this->em;
    }


    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('import:referentiels')
            ->setDescription('script d\'import des referentiels')
            ->addOption(
                'debug',
                'd',
                InputOption::VALUE_REQUIRED,
                'Si défini, affiche dans la console les logs',
                false
            );
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Affichage des logs de débogage dans la console
        $debug = $input->getOption('debug');

        // Initialisation de la configuration de la commande (verrouillage, log, ...)
        $this->init($debug, $output);

        // Appel du traitement de la tâche courante
        $this->executeTask();
        return 0;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function executeTask()
    {
        $em = $this->getEntityManager();


        $names = [
            1 => 'Agriculture',
            2 => 'Agroalimentaire - Alimentation',
            3 => 'Animaux',
            4 => 'Architecture - Aménagement intérieur',
            5 => 'Artisanat - Métiers d\'art',
            6 => 'Banque - Finance - Assurance',
            7 => 'Bâtiment - Travaux publics',
            8 => 'Biologie - Chimie',
            9 => 'Commerce - Immobilier',
            10 => 'Communication - Information',
            11 => 'Culture - Spectacle',
            12 => 'Défense - Sécurité - Secours',
            13 => 'Droit',
            14 => 'Edition - Imprimerie - Livre',
            15 => 'Informatique - électronique',
            16 => 'Enseignement - Formation',
            17 => 'Environnement - Nature - Nettoyage',
            18 => 'Gestion - Audit - Ressources humaines',
            19 => 'Hôtellerie - Restauration - Tourisme',
            20 => 'Industrie - Matériaux',
            21 => 'Lettres - Sciences humaines',
            22 => 'Mécanique - Maintenance',
            23 => 'Numérique - Multimédia - Audiovisuel',
            24 => 'Santé',
            25 => 'Sciences - Maths - Physique',
            26 => 'Secrétariat - Accueil',
            27 => 'Social - Services à la personne',
            28 => 'Soins - Esthétique - Coiffure',
            29 => 'Sport et animation',
            30 => 'Transport - Logistique',
            31 => 'Autres secteurs',
        ];

        foreach ($names as $position => $name) {
            if (null === ($branch = $em->getRepository(Branch::class)->findOneByName($name))) {
                $branch = New Branch();
                $branch->setName($name);
                $em->persist($branch);
                $this->addMessage('insertion de la categorie"' . $name . '"');

            } else {
                $msg = 'categorie "' .
                    $name . '" déjà présent. Mise à jour de la position';
                $this->addMessage($msg);
            }
            $branch->setPosition($position);
        }
        $em->flush();

    }



    /**
     * Démarrage du timer pour le suivi des performances
     *
     * @param string $name Nom du timer dédié
     * @param string $group
     *
     * @throws \Exception
     */
    public function startPL($name, $group = self::LOGGER_WEB_SERVICE_MANTIS)
    {
        $this->getContainer()->get('ops.repository.performer.record')
            ->start($this->getProcName() . '-' . $name, $group);
    }

    /**
     * Ecriture du timer pour le suivi des performances
     *
     * @param        $name
     * @param        $params
     * @param string $group
     *
     * @throws \Exception
     */
    public function flushPL($name, $params, $group = self::LOGGER_WEB_SERVICE_MANTIS)
    {
        $this->getContainer()->get('ops.repository.performer.record')
            ->stop($this->getProcName() . '-' . $name, $group, $params);

    }

    /**
     * Appel de l'initialisation de la commande
     *
     * Cet appel est obligatoire avant chaque démarrage
     *
     * @param bool            $debug Mode débug
     * @param OutputInterface $output
     *
     * @throws \Exception
     */
    public function init($debug, OutputInterface $output)
    {
        // Set le nom de la procédure en cours
        $this->proc_name = 'PROC' . str_pad(time(), 10, "0", STR_PAD_LEFT);
        $this->debug = $debug;
        $this->output = $output;
        $this->is_inited = true;

        $this->initLogger();

        $this->addMessage('démarrage de la commande courante');
    }

    /**
     * Procédure d'initialisation du Logger
     *
     * @throws \Exception
     */
    private function initLogger()
    {
        $this->checkInit(__METHOD__);

        $this->logger = new Logger($this->getProcName());
    }

    /**
     * Procédure de contrôle que la méthode init() a bien été executé en premier
     *
     * @param string $method Méthode qui appelle la procédure de contrôle (normalement récupéré via __METHOD__)
     */
    private function checkInit($method)
    {
        if (!$this->is_inited) {
            exit('you try to execute ' . $method . ' method before execute the init() call');
        }
    }

    /**
     * Récupération le nom de la procédure courante
     *
     * @return null
     */
    public function getProcName()
    {
        $this->checkInit(__METHOD__);

        return $this->proc_name;
    }

    /**
     * Contrôle que l'environnement est en mode Débogage
     *
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Initialisation de la tabulation sur l'écriture des logs
     *
     * @return $this
     */
    public function initTab()
    {
        $this->tab = 0;

        return $this;
    }

    /**
     * Ajout d'une tabulation sur l'écriture des logs
     *
     * @return $this
     */
    public function addTab()
    {
        $this->tab += 5;

        return $this;
    }

    /**
     * Suppression d'une tabulation sur l'écriture des logs
     *
     * @return $this
     */
    public function removeTab()
    {
        if ($this->tab > 0) {
            $this->tab -= 5;
        }

        return $this;
    }

    /**
     * @param string $message
     * @param string $type
     */
    private function addLog($message, $type = 'info')
    {
        if ($this->isDebug()) {
            $message = str_repeat(" ", $this->tab) . $message;
            $this->output->writeln('<' . $type . '>' . $message . '</' . $type . '>');
        }
    }

    /**
     * Ajout d'un log de type "highlightMessage"
     *
     * @param string $message
     *
     * @return KispAbstractImportCommand
     */
    public function addHighLightMessage($message)
    {
        $this->addLog($message, 'question');

        return $this;
    }

    /**
     * Ajout d'un log de type "message"
     *
     * @param string $message
     *
     * @return KispAbstractImportCommand
     */
    public function addMessage($message)
    {
        $this->addLog($message);

        return $this;
    }

    /**
     * Ajout d'un log de type "message" avec PL
     *
     * @param string $message
     *
     * @return KispAbstractImportCommand
     * @throws \Exception
     */
    public function addMessageWithPL($message)
    {
        $this->addLog($message);

        return $this;
    }

    /**
     * Ajout d'un log de type "warning"
     *
     * @param string $message
     *
     * @return KispAbstractImportCommand
     */
    public function addWarning($message)
    {
        $this->addLog($message, 'comment');

        return $this;
    }

    /**
     * Ajout d'un log de type "error"
     *
     * @param string $message
     *
     * @return KispAbstractImportCommand
     */
    public function addError($message)
    {
        $this->addLog($message, 'error');

        return $this;
    }
}
