<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column(length: 20)]
    private string $status = 'En attente';

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    /**
     * @var Collection<int, orderdetails>
     */
    #[ORM\OneToMany(targetEntity: orderdetails::class, mappedBy: 'orders')]
    private Collection $orderdetails;



    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->orderdetails = new ArrayCollection();
       
    }

    public function getId(): ?int { return $this->id; }
    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(int $userId): self { $this->userId = $userId; return $this; }

    public function getTotal(): ?float { return $this->total; }
    public function setTotal(float $total): self { $this->total = $total; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }

    /**
     * @return Collection<int, orderdetails>
     */
    public function getOrderdetails(): Collection
    {
        return $this->orderdetails;
    }

    public function addOrderdetail(orderdetails $orderdetail): static
    {
        if (!$this->orderdetails->contains($orderdetail)) {
            $this->orderdetails->add($orderdetail);
            $orderdetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrderdetail(orderdetails $orderdetail): static
    {
        if ($this->orderdetails->removeElement($orderdetail)) {
            // set the owning side to null (unless already changed)
            if ($orderdetail->getOrders() === $this) {
                $orderdetail->setOrders(null);
            }
        }

        return $this;
    }

  


    }
