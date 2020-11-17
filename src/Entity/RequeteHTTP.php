<?php

namespace App\Entity;

use App\Repository\RequeteHTTPRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=RequeteHTTPRepository::class)
 */
class RequeteHTTP
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ParametreHTTP::class, mappedBy="idrequete")
     */
    private $parametreHTTPs;

    /**
     * @ORM\OneToMany(targetEntity=HeaderHTTP::class, mappedBy="idrequete")
     */
    private $headerHTTPs;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="requeteHTTPs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $iduser;

    public function __construct()
    {
        $this->parametreHTTPs = new ArrayCollection();
        $this->headerHTTPs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|ParametreHTTP[]
     */
    public function getParametreHTTPs(): Collection
    {
        return $this->parametreHTTPs;
    }

    public function addParametreHTTP(ParametreHTTP $parametreHTTP): self
    {
        if (!$this->parametreHTTPs->contains($parametreHTTP)) {
            $this->parametreHTTPs[] = $parametreHTTP;
            $parametreHTTP->setIdrequete($this);
        }

        return $this;
    }

    public function removeParametreHTTP(ParametreHTTP $parametreHTTP): self
    {
        if ($this->parametreHTTPs->removeElement($parametreHTTP)) {
            // set the owning side to null (unless already changed)
            if ($parametreHTTP->getIdrequete() === $this) {
                $parametreHTTP->setIdrequete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HeaderHTTP[]
     */
    public function getHeaderHTTPs(): Collection
    {
        return $this->headerHTTPs;
    }

    public function addHeaderHTTP(HeaderHTTP $headerHTTP): self
    {
        if (!$this->headerHTTPs->contains($headerHTTP)) {
            $this->headerHTTPs[] = $headerHTTP;
            $headerHTTP->setIdrequete($this);
        }

        return $this;
    }

    public function removeHeaderHTTP(HeaderHTTP $headerHTTP): self
    {
        if ($this->headerHTTPs->removeElement($headerHTTP)) {
            // set the owning side to null (unless already changed)
            if ($headerHTTP->getIdrequete() === $this) {
                $headerHTTP->setIdrequete(null);
            }
        }

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }
}
