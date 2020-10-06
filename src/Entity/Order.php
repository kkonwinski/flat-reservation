<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingEnd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBookingStart(): ?\DateTimeInterface
    {
        return $this->bookingStart;
    }

    public function setBookingStart(\DateTimeInterface $bookingStart): self
    {
        $this->bookingStart = $bookingStart;

        return $this;
    }

    public function getBookingEnd(): ?\DateTimeInterface
    {
        return $this->bookingEnd;
    }

    public function setBookingEnd(\DateTimeInterface $bookingEnd): self
    {
        $this->bookingEnd = $bookingEnd;

        return $this;
    }
}
