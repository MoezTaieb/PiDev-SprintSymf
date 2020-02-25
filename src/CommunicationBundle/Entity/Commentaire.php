<?php

namespace CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="CommunicationBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="commentaires")
     * @ORM\JoinColumn(name="commentateur_id",referencedColumnName="id")
     */
    private $commentateur ;



    /**
     * @ORM\ManyToOne(targetEntity="Annonce"  , inversedBy="comments")
     * @ORM\JoinColumn(name="annonce_id",referencedColumnName="id")
     */
    private $annonce ;

    /**
     * @return mixed
     */
    public function getCommentateur()
    {
        return $this->commentateur;
    }

    /**
     * @param mixed $commentateur
     */
    public function setCommentateur($commentateur)
    {
        $this->commentateur = $commentateur;
    }

    /**
     * @return mixed
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * @param mixed $annonce
     */
    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="contenuCommentaire", type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Your comment must be at least {{ limit }} characters long",
     * )
     */
    private $contenuCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommentaire", type="datetime")
     */
    private $dateCommentaire;


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
     * Set contenuCommentaire
     *
     * @param string $contenuCommentaire
     *
     * @return Commentaire
     */
    public function setContenuCommentaire($contenuCommentaire)
    {
        $this->contenuCommentaire = $contenuCommentaire;

        return $this;
    }

    /**
     * Get contenuCommentaire
     *
     * @return string
     */
    public function getContenuCommentaire()
    {
        return $this->contenuCommentaire;
    }

    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     *
     * @return Commentaire
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }
}

