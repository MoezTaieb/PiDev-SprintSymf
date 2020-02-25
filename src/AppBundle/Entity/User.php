<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

   /**
     * @ORM\OneToOne(targetEntity="CampBundle\Entity\Camp" , mappedBy="responsable")
     */
    private $camp ;

    /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Recommandation"  , mappedBy="recommandeur")
     */
    private $recommandation ;



    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\Participation" , mappedBy="participant")
     */
    
    private $participation ;

     /**
     * @ORM\OneToMany(targetEntity="DonBundle\Entity\Argent" , mappedBy="donneur")
     */
    private $argentDon ;

    /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Commentaire" , mappedBy="commentateur")
     */
    private $commentaires ;

     /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Annonce" , mappedBy="posteur")
     */
    private $annonces ;

     /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Message" , mappedBy="emetteur")
     */
    private $messagesEnvoyes;

     /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Message" , mappedBy="destinataire")
     */
    private $messagesReçus;
    /**
     * @ORM\OneToMany(targetEntity="CommunicationBundle\Entity\Notifications" , mappedBy="userNotifier")
     */
    private $notifications;

    /**
     * @return ArrayCollection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param ArrayCollection $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="cinUser", type="string", length=255 , nullable=true)
     */
    private $cinUser;

    /**
     * @return string
     */
    public function getCinUser()
    {
        return $this->cinUser;
    }

    /**
     * @param string $cinUser
     */
    public function setCinUser($cinUser)
    {
        $this->cinUser = $cinUser;
    }

    /**
     * @return string
     */
    public function getAdresseUser()
    {
        return $this->adresseUser;
    }

    /**
     * @param string $adresseUser
     */
    public function setAdresseUser($adresseUser)
    {
        $this->adresseUser = $adresseUser;
    }

    /**
     * @return string
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * @param string $nomUser
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;
    }

    /**
     * @return string
     */
    public function getPrenomUser()
    {
        return $this->prenomUser;
    }

    /**
     * @param string $prenomUser
     */
    public function setPrenomUser($prenomUser)
    {
        $this->prenomUser = $prenomUser;
    }

    /**
     * @return string
     */
    public function getTelUser()
    {
        return $this->telUser;
    }

    /**
     * @param string $telUser
     */
    public function setTelUser($telUser)
    {
        $this->telUser = $telUser;
    }

    /**
     * @return string
     */
    public function getImageUrlUser()
    {
        return $this->imageUrlUser;
    }

    /**
     * @param string $imageUrlUser
     */
    public function setImageUrlUser($imageUrlUser)
    {
        $this->imageUrlUser = $imageUrlUser;
    }

    /**
     * @return string
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * @param string $typeUser
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="nomUser", type="string", length=255)
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUser", type="string", length=255)
     */
    private $prenomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseUser", type="string", length=255)
     */
    private $adresseUser;

    /**
     * @var string
     *
     * @ORM\Column(name="telUser", type="string", length=255, nullable=true)
     */
    private $telUser;



    /**
     * @var string
     *
     * @ORM\Column(name="imageUrlUser", type="string", length=255 ,nullable=true)
     */
    private $imageUrlUser;

    /**
     * @var string
     *
     * @ORM\Column(name="typeUser", type="string", length=255 , nullable=true)
     */
    private $typeUser;






    public function __construct()
    {
        parent::__construct();
        // your own logic
            $this->participation=new ArrayCollection();
            $this->argentDon=new ArrayCollection();
            $this->commentaires=new ArrayCollection();
            $this->annonces=new ArrayCollection();
            $this->messagesEnvoyes=new ArrayCollection();
            $this->messagesReçus=new ArrayCollection();
            $this->recommandation=new ArrayCollection();
        $this->notifications=new ArrayCollection();





    }
}