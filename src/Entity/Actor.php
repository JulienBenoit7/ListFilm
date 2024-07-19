<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Films>
     */
    #[ORM\ManyToMany(targetEntity: Films::class, mappedBy: 'actors')]
    private Collection $films;

    /**
     * @var Collection<int, Series>
     */
    #[ORM\ManyToMany(targetEntity: Series::class, mappedBy: 'actors')]
    private Collection $series;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Films>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Films $film): static
    {
        if (!$this->films->contains($film)) {
            $this->films->add($film);
            $film->addActor($this);
        }

        return $this;
    }

    public function removeFilm(Films $film): static
    {
        if($this->films->removeElement($film)){
            $film->removeActor($this);
    }

        return $this;
    }

    /**
     * @return Collection<int, Series>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSerie(Series $series): static
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->addActor($this);
        }

        return $this;
    }

    public function removeSerie(Series $series): static
    {
        $this->series->removeElement($series);
        $series->removeActor($this);

        return $this;
    }
}
