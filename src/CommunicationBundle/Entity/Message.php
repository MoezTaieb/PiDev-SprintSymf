<?php

namespace CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="CommunicationBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="messagesEnvoyes")
     * @ORM\JoinColumn(name="emetteur_id",referencedColumnName="id")
     */
    private $emetteur ;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="messagesReçus")
     * @ORM\JoinColumn(name="destinataire_id",referencedColumnName="id")
     */
    private $destinataire ;

    /**
     * @return mixed
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * @param mixed $emetteur
     */
    public function setEmetteur($emetteur)
    {
        $this->emetteur = $emetteur;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="contenuMessage", type="text")
     */
    private $contenuMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoiMessage", type="datetime")
     */
    private $dateEnvoiMessage;


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
     * Set contenuMessage
     *
     * @param string $contenuMessage
     *
     * @return Message
     */
    public function setContenuMessage($contenuMessage)
    {
        $this->contenuMessage = $contenuMessage;

        return $this;
    }

    /**
     * Get contenuMessage
     *
     * @return string
     */
    public function getContenuMessage()
    {
        return $this->contenuMessage;
    }

    /**
     * Set dateEnvoiMessage
     *
     * @param \DateTime $dateEnvoiMessage
     *
     * @return Message
     */
    public function setDateEnvoiMessage($dateEnvoiMessage)
    {
        $this->dateEnvoiMessage = $dateEnvoiMessage;

        return $this;
    }

    /**
     * Get dateEnvoiMessage
     *
     * @return \DateTime
     */
    public function getDateEnvoiMessage()
    {
        return $this->dateEnvoiMessage;
    }
}

