<?php

namespace Rha\ProjectManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermittingOptions
 *
 * @ORM\Table(name="permitting_options")
 */
class PermittingOptions
{
    /**
     * @var integer
     */
    private $permittingNamesId;

    /**
     * @var \DateTime
     */
    private $detail;

    /**
     * @var \DateTime
     */
    private $approval;

    /**
     * @var string
     */
    private $detailUserEntered;

    /**
     * @var boolean
     */
    private $aorCanUpdate;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var string
     */
    private $user;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set permittingNamesId
     *
     * @param  integer           $permittingNamesId
     * @return PermittingOptions
     */
    public function setPermittingNamesId($permittingNamesId)
    {
        $this->permittingNamesId = $permittingNamesId;

        return $this;
    }

    /**
     * Get permittingNamesId
     *
     * @return integer
     */
    public function getPermittingNamesId()
    {
        return $this->permittingNamesId;
    }

    /**
     * Set detail
     *
     * @param  \DateTime         $detail
     * @return PermittingOptions
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return \DateTime
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set approval
     *
     * @param  \DateTime         $approval
     * @return PermittingOptions
     */
    public function setApproval($approval)
    {
        $this->approval = $approval;

        return $this;
    }

    /**
     * Get approval
     *
     * @return \DateTime
     */
    public function getApproval()
    {
        return $this->approval;
    }

    /**
     * Set detailUserEntered
     *
     * @param  string            $detailUserEntered
     * @return PermittingOptions
     */
    public function setDetailUserEntered($detailUserEntered)
    {
        $this->detailUserEntered = $detailUserEntered;

        return $this;
    }

    /**
     * Get detailUserEntered
     *
     * @return string
     */
    public function getDetailUserEntered()
    {
        return $this->detailUserEntered;
    }

    /**
     * Set aorCanUpdate
     *
     * @param  boolean           $aorCanUpdate
     * @return PermittingOptions
     */
    public function setAorCanUpdate($aorCanUpdate)
    {
        $this->aorCanUpdate = $aorCanUpdate;

        return $this;
    }

    /**
     * Get aorCanUpdate
     *
     * @return boolean
     */
    public function getAorCanUpdate()
    {
        return $this->aorCanUpdate;
    }

    /**
     * Set timestamp
     *
     * @param  \DateTime         $timestamp
     * @return PermittingOptions
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set user
     *
     * @param  string            $user
     * @return PermittingOptions
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
