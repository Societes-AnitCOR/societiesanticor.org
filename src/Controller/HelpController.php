<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelpController extends AbstractController
{
    /**
     * @Route("/10-facons-d-aider", name="help_more_than_ten_support")
     */
    public function help()
    {
        // Read file with the list of initiatives
        $file_name="../var/listInitiatives.txt";
        $file = fopen($file_name, "r");
        $text = "";
        if (! is_null($file)) {
            $text = fread($file,filesize($file_name));
            fclose($file);
        }


        $re_category = '/^•\s+(.*?)\n(.*?)(?=(?:•\s|\Z))/ms';
        $re_initiative = '/^o\s*(.*?)(?: - (http.*?))?\n(?:^\s*Description\n)?(.*?)\n(?=(?:^o\s|$))/ms';

        $hash_categories = array();

        // Extract the initiatives and their names
        preg_match_all($re_category, $text, $categories, PREG_SET_ORDER, 0);

        foreach ($categories as $category){
            $c_name = $category[1];
            $initiatives_brut = $category[2];

            $hash_categories[$c_name] = array() ;

            preg_match_all($re_initiative, $initiatives_brut, $initiatives, PREG_SET_ORDER, 0);

            foreach ($initiatives as $initiative) {
                $i_name = $initiative[1];
                $i_site = $initiative[2];
                $i_description = $initiative[3];

                $hash_categories[$c_name][$i_name] = array(
                    "site" => $i_site,
                    "description" => $i_description
                );

            }
        }

        return $this->render('main/help.html.twig', [
            "hash_categories" => $hash_categories
        ]);
    }

    /**
     * @Route("/14-secteurs-d-activites", name="help_all_activities_are_necessary")
     */
    public function activitySectors()
    {
        return $this->render('main/activitySectors.html.twig', [
        ]);
    }
}
