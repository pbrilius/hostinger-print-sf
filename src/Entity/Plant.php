<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Plant
 *
 * @ORM\Table(name="plant", indexes={@ORM\Index(name="parentPlant", columns={"parentPlant"})})
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Plant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentPlant", referencedColumnName="id")
     * })
     */
    private $parentplant;

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


}
