<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 05/03/15
 * Time: 00:18
 */

namespace Metinet\AppBundle\Controller;


use Metinet\AppBundle\Entity\User;
use Metinet\AppBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller{

    public function signUpAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if ($request->isMethod("POST")) {
            $form->submit($request);
            if ($form->isValid()) {
                    var_dump($request);

            }
        }
        return $this->render(
            "MetinetAppBundle:Fact:createForm.html.twig",
            ["form" => $form->createView()]
        );
    }
}
