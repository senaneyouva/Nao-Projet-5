<?php

namespace BT\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BT\UserBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements AdvancedUserInterface, EncoderAwareInterface
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
     * @ORM\Column(name="username", type="string", length=48, unique=true)
     * @Assert\NotBlank(message="Merci de saisir un identifiant")
     * @Assert\Length(min = 3, minMessage="Merci de saisir au moins 3 caractères")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=145, unique=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=145, unique=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * @var string
     * @Assert\Length(min = 3, minMessage="Merci de saisir au moins 3 caractères")
     */
    private $plainPassword;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255, unique=true, nullable=true)
     */
    private $confirmationToken = null;

    /**
     * @var string
     *
     * @ORM\Column(name="forgot_token", type="string", length=255, nullable=true, unique=true)
     */
    private $forgotToken;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirm", type="boolean")
     */
    private $confirm = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="naturaliste", type="boolean")
     */
    private $naturaliste;

    /**
     * @var bool
     *
     * @ORM\Column(name="naturaliste_confirm", type="boolean")
     */
    private $naturalisteConfirm = false;


    /**
     * @ORM\OneToMany(targetEntity="\BT\NaoBundle\Entity\Observation", mappedBy="user", cascade={"persist", "remove"})
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="\BT\NaoBundle\Entity\Post", mappedBy="author", cascade={"persist", "remove"})
     */
    private $posts;



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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set confirmationToken
     *
     *
     * @return User
     */
    public function setConfirmationToken($choice)
    {
        $confirmationToken = $this->confirmationToken;
        if ($choice == true) {
            $token = bin2hex(random_bytes(17));
            $this->confirmationToken = $token;
            return $this;
        }
        return $confirmationToken;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set forgotToken
     *
     * @return User
     */
    public function setForgotToken()
    {
        $token = bin2hex(random_bytes(14));
        $this->forgotToken = $token;

        return $this;
    }

    /**
     * Get forgotToken
     *
     * @return string
     */
    public function getForgotToken()
    {
        return $this->forgotToken;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getEncoderName()
    {
        return 'harsh';
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $confirm
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->confirm;
    }

    /**
     * Set naturaliste
     *
     * @param bool $naturaliste
     *
     * @return User
     */
    public function setNaturaliste($naturaliste)
    {
        $this->naturaliste = $naturaliste;

        return $this;
    }

    /**
     * Get naturaliste
     *
     * @return bool
     */
    public function getNaturaliste()
    {
        return $this->naturaliste;
    }



    /**
     * Set naturalisteConfirm
     *
     * @param boolean $naturalisteConfirm
     *
     * @return User
     */
    public function setNaturalisteConfirm($naturalisteConfirm)
    {
        $this->naturalisteConfirm = $naturalisteConfirm;

        return $this;
    }

    /**
     * Get naturalisteConfirm
     *
     * @return boolean
     */
    public function getNaturalisteConfirm()
    {
        return $this->naturalisteConfirm;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add observation
     *
     * @param \BT\NaoBundle\Observation $observation
     *
     * @return User
     */
    public function addObservation(\BT\NaoBundle\Entity\Observation $observation)
    {
        $this->observations[] = $observation;

        return $this;
    }

    /**
     * Remove observation
     *
     * @param \BT\NaoBundle\Observation $observation
     */
    public function removeObservation(\BT\NaoBundle\Entity\Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * Get observations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Add post
     *
     * @param \BT\NaoBundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\BT\NaoBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \BT\NaoBundle\Entity\Post $post
     */
    public function removePost(\BT\NaoBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
