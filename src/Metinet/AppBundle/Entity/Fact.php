<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\AppBundle\Entity;

class Fact
{
    protected $id;
    protected $number;
    protected $summary;
    protected $authorEmail;
    protected $status;

    public function __construct($number = null, $summary = null)
    {
        $this->number  = $number;
        $this->summary = $summary;
        $this->status  = FactStatus::PENDING;
    }

    public function setId($id)
    {
        if (null !== $this->id) {
            throw new \Exception("Can't update Entity id");
        }

        $this->id = $id;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    public function setEmail($email)
    {
        $this->authorEmail = $email;
    }

    public function getEmail()
    {
        return $this->authorEmail;
    }

    public function setStatus($status)
    {
        if (!in_array($status, [FactStatus::ACCEPTED, FactStatus::PENDING, FactStatus::REFUSED])) {

            throw new \InvalidArgumentException("Invalid status");
        }

        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getSummary()
    {
        return $this->summary;
    }
}
