<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoricalDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "post",
 *      },
 *      itemOperations={
 *          "get"={
 *              "controller"=NotFoundAction::class,
 *              "read"=false,
 *              "output"=false,
 *          },
 *      },
 * )
 * @ORM\Entity(repositoryClass=HistoricalDataRepository::class)
 */
class HistoricalData extends ReportData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $company_symbol;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTimeInterface")
     * @Assert\Expression(
     *      expression="value < this.getEndDate()",
     *      message="Start date value must have to be less than the end date value"
     * )
     * @Assert\LessThan("today")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTimeInterface")
     * @Assert\Expression(
     *      expression="value > this.getStartDate()",
     *      message="End date value must have to be bigger than the start date value"
     * )
     * @Assert\LessThanOrEqual("today")
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanySymbol(): ?string
    {
        return $this->company_symbol;
    }

    public function setCompanySymbol(string $company_symbol): self
    {
        $this->company_symbol = $company_symbol;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

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
}
