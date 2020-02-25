<?php

namespace CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommandation
 *
 * @ORM\Table(name="recommandation")
 * @ORM\Entity(repositoryClass="CommunicationBundle\Repository\RecommandationRepository")
 */
class Recommandation
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="recommandation")
     * @ORM\JoinColumn(name="recommandeur_id",referencedColumnName="id")
     */
    private $recommandeur;
    /**
     * @ORM\ManyToOne(targetEntity="Annonce"  , inversedBy="recommandations")
     * @ORM\JoinColumn(name="annonce_id",referencedColumnName="id")
     */
    private $annonce ;

    /**
     * @return mixed
     */
    public function getRecommandeur()
    {
        return $this->recommandeur;
    }

    /**
     * @param mixed $recommandeur
     */
    public function setRecommandeur($recommandeur)
    {
        $this->recommandeur = $recommandeur;
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

}

