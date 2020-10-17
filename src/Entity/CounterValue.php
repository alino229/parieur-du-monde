<?php

namespace App\Entity;

use App\Repository\CounterValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CounterValueRepository::class)
 */
class CounterValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dayId;

    /**
     * @ORM\Column(type="integer")
     */
    private $dayValue;

    /**
     * @ORM\Column(type="integer")
     */
    private $yesterdayId;

    /**
     * @ORM\Column(type="integer")
     */
    private $yesterdayValue;

    /**
     * @ORM\Column(type="integer")
     */
    private $weekId;

    /**
     * @ORM\Column(type="integer")
     */
    private $weekValue;

    /**
     * @ORM\Column(type="integer")
     */
    private $monthId;

    /**
     * @ORM\Column(type="integer")
     */
    private $monthValue;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearId;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearValue;

    /**
     * @ORM\Column(type="integer")
     */
    private $allValue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $recordDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $recordValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayId(): ?int
    {
        return $this->dayId;
    }

    public function setDayId(int $dayId): self
    {
        $this->dayId = $dayId;

        return $this;
    }

    public function getDayValue(): ?int
    {
        return $this->dayValue;
    }

    public function setDayValue(int $dayValue): self
    {
        $this->dayValue = $dayValue;

        return $this;
    }

    public function getYesterdayId(): ?int
    {
        return $this->yesterdayId;
    }

    public function setYesterdayId(int $yesterdayId): self
    {
        $this->yesterdayId = $yesterdayId;

        return $this;
    }

    public function getYesterdayValue(): ?int
    {
        return $this->yesterdayValue;
    }

    public function setYesterdayValue(int $yesterdayValue): self
    {
        $this->yesterdayValue = $yesterdayValue;

        return $this;
    }

    public function getWeekId(): ?int
    {
        return $this->weekId;
    }

    public function setWeekId(int $weekId): self
    {
        $this->weekId = $weekId;

        return $this;
    }

    public function getWeekValue(): ?int
    {
        return $this->weekValue;
    }

    public function setWeekValue(int $weekValue): self
    {
        $this->weekValue = $weekValue;

        return $this;
    }

    public function getMonthId(): ?int
    {
        return $this->monthId;
    }

    public function setMonthId(int $monthId): self
    {
        $this->monthId = $monthId;

        return $this;
    }

    public function getMonthValue(): ?int
    {
        return $this->monthValue;
    }

    public function setMonthValue(int $monthValue): self
    {
        $this->monthValue = $monthValue;

        return $this;
    }

    public function getYearId(): ?int
    {
        return $this->yearId;
    }

    public function setYearId(int $yearId): self
    {
        $this->yearId = $yearId;

        return $this;
    }

    public function getYearValue(): ?int
    {
        return $this->yearValue;
    }

    public function setYearValue(int $yearValue): self
    {
        $this->yearValue = $yearValue;

        return $this;
    }

    public function getAllValue(): ?int
    {
        return $this->allValue;
    }

    public function setAllValue(int $allValue): self
    {
        $this->allValue = $allValue;

        return $this;
    }

    public function getRecordDate(): ?\DateTimeInterface
    {
        return $this->recordDate;
    }

    public function setRecordDate(\DateTimeInterface $recordDate): self
    {
        $this->recordDate = $recordDate;

        return $this;
    }

    public function getRecordValue(): ?int
    {
        return $this->recordValue;
    }

    public function setRecordValue(int $recordValue): self
    {
        $this->recordValue = $recordValue;

        return $this;
    }
}
