<?php

namespace App\Entity;

use App\Repository\MerchantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
class Merchant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, GiftCard>
     */
    #[ORM\OneToMany(targetEntity: GiftCard::class, mappedBy: 'Merchant')]
    private Collection $GiftCard;

    public function __construct()
    {
        $this->GiftCard = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, GiftCard>
     */
    public function getGiftCard(): Collection
    {
        return $this->GiftCard;
    }

    public function addGiftCard(GiftCard $GiftCard): static
    {
        if (!$this->GiftCard->contains($GiftCard)) {
            $this->GiftCard->add($GiftCard);
            $GiftCard->setMerchant($this);
        }

        return $this;
    }

    public function removeGiftCard(GiftCard $GiftCard): static
    {
        if ($this->GiftCard->removeElement($GiftCard)) {
            // set the owning side to null (unless already changed)
            if ($GiftCard->getMerchant() === $this) {
                $GiftCard->setMerchant(null);
            }
        }

        return $this;
    }
}
