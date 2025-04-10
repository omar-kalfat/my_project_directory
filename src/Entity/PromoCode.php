<?php

namespace App\Entity;

use App\Repository\PromoCodeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromoCodeRepository::class)]
class PromoCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?float $reduction = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expirydate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Merchant $merchant = null;

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

    public function getReduction(): ?float
    {
        return $this->reduction;
    }

    public function setReduction(float $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getExpirydate(): ?\DateTimeInterface
    {
        return $this->expirydate;
    }

    public function setExpirydate(\DateTimeInterface $expirydate): static
    {
        $this->expirydate = $expirydate;

        return $this;
    }

    public function getMerchantId(): ?merchant
    {
        return $this->merchant;
    }

    public function setMerchantId(?merchant $merchantId): static
    {
        $this->merchantId = $merchantId;

        return $this;
    }
}
