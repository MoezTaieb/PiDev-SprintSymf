<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invite
 *
 * @ORM\Table(name="invite")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\InviteRepository")
 */
class Invite
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
     * @ORM\ManyToOne(targetEntity="Evenement" , inversedBy="invites")
     * @ORM\JoinColumn(name="evenement_id",referencedColumnName="id")
     */
    private $evenement ;

    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="nomInvite", type="string", length=255)
     */
    private $nomInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomInvite", type="string", length=255)
     */
    private $prenomInvite;


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
     * Set nomInvite
     *
     * @param string $nomInvite
     *
     * @return Invite
     */
    public function setNomInvite($nomInvite)
    {
        $this->nomInvite = $nomInvite;

        return $this;
    }

    /**
     * Get nomInvite
     *
     * @return string
     */
    public function getNomInvite()
    {
        return $this->nomInvite;
    }

    /**
     * Set prenomInvite
     *
     * @param string $prenomInvite
     *
     * @return Invite
     */
    public function setPrenomInvite($prenomInvite)
    {
        $this->prenomInvite = $prenomInvite;

        return $this;
    }

    /**
     * Get prenomInvite
     *
     * @return string
     */
    public function getPrenomInvite()
    {
        return $this->prenomInvite;
    }
}

