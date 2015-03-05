<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 05/03/15
 * Time: 01:38
 */

namespace Metinet\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ApiController  extends Controller
{




    public function apiAction(){
        $facts = $this->get("fact_repository")->findAll();
        $jsonContent = $this->get("fact_serialize")->serilizerFact()->serialize($facts, 'json');

        return $this->render(
            "MetinetAppBundle:Fact:api.html.twig",
            ["jsonFact" => $jsonContent]
        );
    }
}