<?php

namespace Metinet\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FactController extends Controller
{
    public function homeAction(){
     /*   $facts = [
            [
                "number" => 900000,
                "summary" => "La longueur en kilomètres du réseau de canalisations d'eau potable français"
            ],
            [
                "number" => 5,
                "summary" => "C'est le nombre de rhinocéroos blancs du Nord encore en vie : deux dans des zoos, trois dans une réserve kenyane"
            ]
        ];
return $this->render('MetinetAppBundle:Fact:home.html.twig',array(
    "facts" => $facts
));*/
        $inMemoryRepository = new \InMemoryRepository();

        return $this->render('MetinetAppBundle:Fact:home.html.twig',array(
            "facts" => $inMemoryRepository->findAll()));

    }
}
