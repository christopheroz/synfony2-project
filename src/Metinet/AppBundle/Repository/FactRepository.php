<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\AppBundle\Repository;

use Metinet\AppBundle\Entity\Fact;

interface FactRepository
{
    public function findAll();

    public function findById($id);

    public function findAccepted();

    public function findPending();

    public function pickRandom();

    public function save(Fact $fact);
}
