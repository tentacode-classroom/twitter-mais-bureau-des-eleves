<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar = "https://cms.qz.com/wp-content/uploads/2017/03/twitter_egg_blue.png?w=900&h=900&crop=1&strip=all&quality=75";

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $promotion;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $training;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $tweet;

    /**
     * @ORM\Column(type="integer")
     */
    private $tweet_nb;

    /**
     * @ORM\Column(type="boolean")
     */
    private $BDE;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Likes", mappedBy="user")
     */
    private $likes;

    /**
     * @ORM\Column(type="integer")
     */
    private $like_nb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Follow", mappedBy="followed")
     */
    private $follows;

    public function __construct()
    {
        $this->isActive = true;
        $this->messages = new ArrayCollection();
        $this->tweet = new ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->tweet_nb = 0;
        $this->like_nb = 0;
        $this->BDE = 0;
        $this->likes = new ArrayCollection();
        $this->follows = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getTraining(): ?string
    {
        return $this->training;
    }

    public function setTraining(string $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getTweet(): Collection
    {
        return $this->tweet;
    }

    public function addTweet(Message $tweet): self
    {
        if (!$this->tweet->contains($tweet)) {
            $this->tweet[] = $tweet;
            $tweet->setUser($this);
        }

        return $this;
    }

    public function removeTweet(Message $tweet): self
    {
        if ($this->tweet->contains($tweet)) {
            $this->tweet->removeElement($tweet);
            // set the owning side to null (unless already changed)
            if ($tweet->getUser() === $this) {
                $tweet->setUser(null);
            }
        }

        return $this;
    }

    public function getTweetNb(): ?int
    {
        return $this->tweet_nb;
    }

    public function setTweetNb(int $tweet_nb): self
    {
        $this->tweet_nb = $tweet_nb;

        return $this;
    }

    public function increementTweet() {
        $this->tweet_nb++;
    }

    public function getBDE(): ?bool
    {
        return $this->BDE;
    }

    public function setBDE(bool $BDE): self
    {
        $this->BDE = $BDE;

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Likes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(Likes $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Follow[]
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function addFollow(Follow $follow): self
    {
        if (!$this->follows->contains($follow)) {
            $this->follows[] = $follow;
            $follow->setFollowed($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): self
    {
        if ($this->follows->contains($follow)) {
            $this->follows->removeElement($follow);
            // set the owning side to null (unless already changed)
            if ($follow->getFollowed() === $this) {
                $follow->setFollowed(null);
            }
        }

        return $this;
    }

    public function getLikeNb(): ?int
    {
        return $this->like_nb;
    }

    public function setLikeNb(int $like_nb): self
    {
        $this->like_nb = $like_nb;

        return $this;
    }

    public function increementLike() {
        $this->like_nb++;
    }
}