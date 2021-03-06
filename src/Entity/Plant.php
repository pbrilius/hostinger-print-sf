<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Plant
 *
 * @ORM\Table(name="plant", indexes={@ORM\Index(name="parentPlant", columns={"parentPlant"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Assert\GroupSequence({"Plant", "Strict"})
 */
class Plant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="categoryName", type="string", length=256, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(max=256)
     */
    private $categoryname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @var \Plant
     *
     * @ORM\ManyToOne(targetEntity="Plant", inversedBy="inheritingPlants", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentPlant", referencedColumnName="id")
     * })
     * @MaxDepth(16)
     */
    private $parentplant;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Plant", mappedBy="parentplant", orphanRemoval=true)
     * @MaxDepth(2)
     */
    private $inheritingPlants;
    
    public function __construct()
    {
        $this->inheritingPlants = new ArrayCollection();
    }
    
    /**
     *  @ORM\PreUpdate
     */
    public function setUpdatedAtOnPreUpdate()
    {
        $this->updatedat = new \DateTime();
    }
    
    public function __toString()
    {
        return $this->categoryname;
    }
    
    /**
     * @Assert\IsFalse(message="Parent plant cannot reference plant", groups={"Strict"})
     */
    public function isReferencingSelf()
    {
        return (!is_null($this->parentplant) && $this->getId() == $this->parentplant->getId());
    }
    
    /**
     *  @ORM\PrePersist
     */
    public function setCreatedAtOnPrePersist()
    {
        $this->createdat = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryname(): ?string
    {
        return $this->categoryname;
    }

    public function setCategoryname(?string $categoryname): self
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getUpdatedat(): ?\DateTimeInterface
    {
        return $this->updatedat;
    }

    public function setUpdatedat(?\DateTimeInterface $updatedat): self
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    public function getParentplant(): ?self
    {
        return $this->parentplant;
    }

    public function setParentplant(?self $parentplant): self
    {
        $this->parentplant = $parentplant;

        return $this;
    }
    
    public function getInheritingPlants(): Collection
    {
        return $this->inheritingPlants;
    }

    public function setInheritingPlants(ArrayCollection $inheritingPlants)
    {
        $this->inheritingPlants = $inheritingPlants;
        return $this;
    }
}
