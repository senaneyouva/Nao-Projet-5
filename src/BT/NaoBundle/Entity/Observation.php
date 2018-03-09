<?php

namespace BT\NaoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BT\UserBundle\Entity\User;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="BT\NaoBundle\Repository\ObservationRepository")
 * @Vich\Uploadable
 */
class Observation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank(message="Merci de remplir ce champs")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     * @Assert\NotBlank(message="Merci de remplir ce champs")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     * @Assert\NotBlank(message="Merci de remplir ce champs")
     */
    private $longitude;


    /**
     * Many Observations have One Bird
     * @ORM\ManyToOne(targetEntity="Bird")
     * @ORM\JoinColumn(name="bird_id", referencedColumnName="id")
     */
    private $bird;

    /**
     * @ORM\ManyToOne(targetEntity="BT\UserBundle\Entity\User", inversedBy="observations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Vich\UploadableField(mapping="observations", fileNameProperty="ObservationName")
     * @Assert\Image(
     *     mimeTypesMessage = "Image au format jpg ou png"
     * )
     */
    private $observationFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $observationName;

    /**
     * @ORM\Column(name="confirm", type="integer")
     */
    private $confirm;

    /**
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank(message="Merci de remplir ce champs")
     */
    private $content;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Observation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Observation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Observation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set bird
     *
     * @param \BT\NaoBundle\Entity\Bird $bird
     *
     * @return Observation
     */
    public function setBird(\BT\NaoBundle\Entity\Bird $bird = null)
    {
        $this->bird = $bird;

        return $this;
    }

    /**
     * Get bird
     *
     * @return \BT\NaoBundle\Entity\Bird
     */
    public function getBird()
    {
        return $this->bird;
    }

    /**
     * Set user
     *
     * @param \BT\UserBundle\Entity\User $user
     *
     * @return Observation
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BT\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $devis
     *
     * @return Observation
     */
    public function setObservationFile(File $observation = null)
    {
        $this->observationFile = $observation;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getObservationFile()
    {
        return $this->observationFile;
    }

    /**
     * @param string $devisName
     *
     * @return Observation
     */
    public function setObservationName($observationName)
    {
        $this->observationName = $observationName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservationName()
    {
        return $this->observationName;
    }

    /**
     * Set confirm
     *
     * @param integer $confirm
     *
     * @return Observation
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Get confirm
     *
     * @return boolean
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
