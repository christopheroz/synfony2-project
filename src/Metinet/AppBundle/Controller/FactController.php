<?php

namespace Metinet\AppBundle\Controller;

use Metinet\AppBundle\Entity\Fact;
use Metinet\AppBundle\Entity\FactStatus;
use Metinet\AppBundle\Form\Type\FactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FactController extends Controller
{
    public function homeAction()
    {
        $facts = $this->get("fact_repository")->findAccepted();

        return $this->render(
            'MetinetAppBundle:Fact:home.html.twig',
            ['facts' => $facts]
        );
    }

    public function randomAction()
    {
        $fact = $this->get("fact_repository")->pickRandom();

        return $this->render(
            "MetinetAppBundle:Fact:random.html.twig",
            ["fact" => $fact]
        );
    }

    public function submitAction(Request $request)
    {
        $fact = new Fact();
        $form = $this->createForm(new FactType(), $fact);

        if ($request->isMethod("POST")) {
            $form->submit($request);
            if ($form->isValid()) {

                $this->get('fact_repository')->save($fact);

                return new RedirectResponse(
                    $this->generateUrl("home")
                );
            }
        }

        return $this->render(
            "MetinetAppBundle:Fact:submit.html.twig",
            ["form" => $form->createView()]
        );
    }

    public function listPendingFactsAction()
    {
        $facts = $this->get("fact_repository")->findPending();

        return $this->render(
            'MetinetAppBundle:Fact:listPendingFacts.html.twig',
            ['facts' => $facts]
        );
    }

    public function changeFactStatusAction($id, $status)
    {
        $fact = $this->get("fact_repository")->findById($id);
        if (!in_array($status, [FactStatus::REFUSED, FactStatus::ACCEPTED])) {

            throw new \InvalidArgumentException(sprintf('Invalid status: "%s"', $status));
        }

        $fact->setStatus($status);

        $this->get("fact_repository")->save($fact);

        return new RedirectResponse(
            $this->generateUrl("pending_facts")
        );
    }
}
