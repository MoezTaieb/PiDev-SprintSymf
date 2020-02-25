<?php

namespace CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notifications
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity(repositoryClass="CommunicationBundle\Repository\NotificationsRepository")
 */
class Notifications
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
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var int
     *
     * @ORM\Column(name="vue", type="integer", options={"default":0} )
     */
    private $vue;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="notifications")
     * @ORM\JoinColumn(name="userNotifier_id",referencedColumnName="id")
     */
    private $userNotifier ;

    /**
     * @return mixed
     */
    public function getUserNotifier()
    {
        return $this->userNotifier;
    }

    /**
     * @param mixed $userNotifier
     */
    public function setUserNotifier($userNotifier)
    {
        $this->userNotifier = $userNotifier;
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Notifications
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set vue
     *
     * @param integer $vue
     *
     * @return Notifications
     */
    public function setVue($vue)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return int
     */
    public function getVue()
    {
        return $this->vue;
    }
}

