<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetricsDataRepository")
 */
class MetricsData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="integer")
     */
    public $cpu_load;

    /**
     * @ORM\Column(type="float")
     */
    private $concurrency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getCpuLoad(): ?float
    {
        return $this->cpu_load;
    }

    public function setCpuLoad(float $cpu_load): self
    {
        $this->cpu_load = $cpu_load;

        return $this;
    }

    public function getConcurrency(): ?int
    {
        return $this->concurrency;
    }

    public function setConcurrency(int $concurrency): self
    {
        $this->concurrency = $concurrency;

        return $this;
    }

    public function generateTimestamp(int $minutes){
        $current_timestamp = time();
        return $current_timestamp - ($minutes*60);
    }

    public function generateCPULoad(){
        return mt_rand(0,1000)/10;
    }

    public function generateConcurrency(){
        return mt_rand(0,500000);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'timestamp' => $this->getTimestamp(),
            'cpu_load' => $this->getCpuLoad(),
            'concurrency' => $this->getConcurrency(),
        ];
    }
}
