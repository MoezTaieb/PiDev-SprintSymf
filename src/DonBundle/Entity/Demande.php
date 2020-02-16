<?php

namespace DonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="DonBundle\Repository\DemandeRepository")
 */
class Demande
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
     * @ORM\Column(name="remarqueDemande", type="text")
     */
    private $remarqueDemande;

    /**
     * @ORM\ManyToOne(targetEntity="CampBundle\Entity\Camp" , inversedBy="demandes")
     * @ORM\JoinColumn(name="camp_id",referencedColumnName="id")
     */
    private $camp ;

    /**
     * @ORM\ManyToOne(targetEntity="Equipment" , inversedBy="demandes")
     * @ORM\JoinColumn(name="equipment_id",referencedColumnName="id")
     */
    private $equipment ;

    /**
     * @ORM\ManyToOne(targetEntity="Service" , inversedBy="demandes")
     * @ORM\JoinColumn(name="service_id",referencedColumnName="id")
     */
    private $service ;

    /**
     * @ORM\ManyToOne(targetEntity="Argent" , inversedBy="demandes")
     * @ORM\JoinColumn(name="argent_id",referencedColumnName="id")
     */
    private $argent ;

    /**
     * @return mixed
     */
    public function getArgent()
    {
        return $this->argent;
    }

    /**
     * @param mixed $argent
     */
    public function setArgent($argent)
    {
        $this->argent = $argent;
    }
    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * @param mixed $equipment
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;
    }


    /**
     * @return mixed
     */
    public function getCamp()
    {
        return $this->camp;
    }

    /**
     * @param mixed $camp
     */
    public function setCamp($camp)
    {
        $this->camp = $camp;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="etatDemande", type="string", length=255)
     */
    private $etatDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="casDemande", type="string", length=255)
     */
    private $casDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDemande", type="datetime")
     */
    private $dateDemande;


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
     * Set remarqueDemande
     *
     * @param string $remarqueDemande
     *
     * @return Demande
     */
    public function setRemarqueDemande($remarqueDemande)
    {
        $this->remarqueDemande = $remarqueDemande;

        return $this;
    }

    /**
     * Get remarqueDemande
     *
     * @return string
     */
    public function getRemarqueDemande()
    {
        return $this->remarqueDemande;
    }

    /**
     * Set etatDemande
     *
     * @param string $etatDemande
     *
     * @return Demande
     */
    public function setEtatDemande($etatDemande)
    {
        $this->etatDemande = $etatDemande;

        return $this;
    }

    /**
     * Get etatDemande
     *
     * @return string
     */
    public function getEtatDemande()
    {
        return $this->etatDemande;
    }

    /**
     * Set casDemande
     *
     * @param string $casDemande
     *
     * @return Demande
     */
    public function setCasDemande($casDemande)
    {
        $this->casDemande = $casDemande;

        return $this;
    }

    /**
     * Get casDemande
     *
     * @return string
     */
    public function getCasDemande()
    {
        return $this->casDemande;
    }

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Demande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }
}

