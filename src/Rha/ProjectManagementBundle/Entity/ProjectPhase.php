<?php

namespace Rha\ProjectManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectPhase
 *
 * @ORM\Table(name="project_phase")
 */
class ProjectPhase
{
    /**
     * @var string
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var string
     * @ORM\Column(type="string", length=40)
     */
    private $user;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Set name
     *
     * @param  string       $name
     * @return ProjectPhase
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param  string       $user
     * @return ProjectPhase
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
