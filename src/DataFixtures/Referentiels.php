<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;



use App\Command\ImportCommand;

class Referentiels extends Fixture
{
    public function load(ObjectManager $em)
    {


        $kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'import:referentiels',
            '-d' => false,
        ]);

        $output = new ConsoleOutput();
        
        $output->write("\tExecuting Référentiels\n");
        
        $em->commit();
        $application->run($input, $output);
        $em->beginTransaction();
        
    }
}
