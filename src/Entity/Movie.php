<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use App\Trait\Entity\HasSoftDelete;
use App\Trait\Entity\HasTimestamp;
use App\Trait\Entity\HasPublished;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\Table(name: 'movies')]
#[HasLifecycleCallbacks]
class Movie
{
    use HasPublished,
        HasTimestamp,
        HasSoftDelete;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $releaseDate = null;

    /**
     * @var Collection<int, Country>
     */
    #[ORM\ManyToMany(targetEntity: Country::class, inversedBy: 'movies')]
    private Collection $countries;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'movies')]
    private Collection $genres;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
        $this->genres = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTime $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return Collection<int, Country>
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): static
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
            $country->addMovie($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): static
    {
        if ($this->countries->removeElement($country)) {
            $country->removeMovie($this);
        }

        return $this;
    }

    /**
     * @param Country[] $countries
     */
    public function syncCountries(array $countries): static
    {
        foreach ($this->countries as $country) {
            if (!in_array($country, $countries, true)) {
                $this->removeCountry($country);
            }
        }

        foreach ($countries as $country) {
            $this->addCountry($country);
        }

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addMovie($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeMovie($this);
        }

        return $this;
    }

    /**
     * @param Genre[] $genres
     */
    public function syncGenres(array $genres): static
    {
        foreach ($this->genres as $genre) {
            if (!in_array($genre, $genres, true)) {
                $this->removeGenre($genre);
            }
        }

        foreach ($genres as $genre) {
            $this->addGenre($genre);
        }

        return $this;
    }
}
