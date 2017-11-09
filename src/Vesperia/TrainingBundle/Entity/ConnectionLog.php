<?php

namespace Vesperia\TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConnectionLog
 *
 * @ORM\Entity(repositoryClass="Vesperia\TrainingBundle\Entity\Repository\ConnectionLogRepository")
 * @ORM\Table(name="connection_log")
 */
class ConnectionLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="clientIp", type="string", length=39)
     */
    private $clientIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    public function __construct($clientIp)
    {
        $this->clientIp = $clientIp;
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clientIp
     *
     * @param string $clientIp
     *
     * @return ConnectionLog
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;

        return $this;
    }

    /**
     * Get clientIp
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
