<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Scheb\TwoFactorBundle\Model\TrustedComputerInterface;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class User extends BaseUser implements EncoderAwareInterface, TwoFactorInterface, TrustedComputerInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Query", inversedBy="user")
     */
    protected $query;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Hook on pre-update operations
     */
    public function preUpdate()
    {
        $this->lastLogin = clone $this->updatedAt;
        $this->updatedAt = new \DateTime();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery(Query $query)
    {
        $this->query = $query;

        return $this;
    }
    
    /**
     * @ORM\Column(type="string", length=25, options={"default": "legacy"})
     */
    protected $encoderName;
    
    public function setEncoderName($name)
    {
        $this->encoderName = $name;
        
        return $this;
    }
    
    public function getEncoderName()
    {
        return $this->encoderName;
    }
    
    /*
     * Implement the TwoFactorInterface
     */
    
    /**
     * Return true if the user should do two-factor authentication
     *
     * @return boolean
     */
    protected $emailAuthEnabled;
    
    public function setEmailAuthEnabled($enable)
    {
        $this->emailAuthEnabled = $enabled;
        
        return $this;
    }
    
    public function isEmailAuthEnabled()
    {
        return $this->emailAuthEnabled;
    }
    
    /**
     * Return users email address
     *
     * @return string
     * this function is implemented by the FOSUserBundle
    public function getEmail();*/
    
    /**
     * Return the authentication code
     *
     * @return integer
     */
    protected $emailAuthCode;
    
    public function setEmailAuthCode($code)
    {
        $this->emailAuthCode = $code;
        
        return $this;
    }
    
    public function getEmailAuthCode()
    {
        return $this->emailAuthCode;
    }
    
    /*
     * Implement the TrustedComputerInterface
     */
    
    protected $trustedComputer;
    
    public function addTrustedComputer($token, \DateTime $validUntil)
    {
        $this->trustedComputer[$token] = $validUntil->format("r");
        
        return $this;
    }
    
    public function isTrustedComputer($token)
    {
        if (isset($this->trustedComputer[$token])) {
            $now = new \DateTime();
            
            $validUntil = new \DateTime($this->trustedComputer[$token]);
            
            return $now < $validUntil;
        }
        
        return false;
    }
}