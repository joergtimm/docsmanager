<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $iso2 = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $iso3 = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $tldomain = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $fips = null;

    #[ORM\Column(nullable: true)]
    private ?int $isonumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $geoNameId = null;

    #[ORM\Column(nullable: true)]
    private ?int $e164 = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phoneCode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $continent = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $capital = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $timeZoneCapital = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $currency = null;

    #[ORM\Column(nullable: true)]
    private ?array $languageCodes = null;

    #[ORM\Column(nullable: true)]
    private ?int $area = null;

    #[ORM\Column(nullable: true)]
    private ?int $mobilePhones = null;

    #[ORM\Column(nullable: true)]
    private ?int $landlinePhones = null;

    #[ORM\Column(nullable: true)]
    private ?int $gdp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $flag = null;

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

    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    public function setIso2(?string $iso2): static
    {
        $this->iso2 = $iso2;

        return $this;
    }

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function setIso3(?string $iso3): static
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getTldomain(): ?string
    {
        return $this->tldomain;
    }

    public function setTldomain(?string $tldomain): static
    {
        $this->tldomain = $tldomain;

        return $this;
    }

    public function getFips(): ?string
    {
        return $this->fips;
    }

    public function setFips(?string $fips): static
    {
        $this->fips = $fips;

        return $this;
    }

    public function getIsonumber(): ?int
    {
        return $this->isonumber;
    }

    public function setIsonumber(?int $isonumber): static
    {
        $this->isonumber = $isonumber;

        return $this;
    }

    public function getGeoNameId(): ?int
    {
        return $this->geoNameId;
    }

    public function setGeoNameId(?int $geoNameId): static
    {
        $this->geoNameId = $geoNameId;

        return $this;
    }

    public function getE164(): ?int
    {
        return $this->e164;
    }

    public function setE164(?int $e164): static
    {
        $this->e164 = $e164;

        return $this;
    }

    public function getPhoneCode(): ?string
    {
        return $this->phoneCode;
    }

    public function setPhoneCode(?string $phoneCode): static
    {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    public function getContinent(): ?string
    {
        return $this->continent;
    }

    public function setContinent(?string $continent): static
    {
        $this->continent = $continent;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(?string $capital): static
    {
        $this->capital = $capital;

        return $this;
    }

    public function getTimeZoneCapital(): ?string
    {
        return $this->timeZoneCapital;
    }

    public function setTimeZoneCapital(?string $timeZoneCapital): static
    {
        $this->timeZoneCapital = $timeZoneCapital;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getLanguageCodes(): ?array
    {
        return $this->languageCodes;
    }

    public function setLanguageCodes(?array $languageCodes): static
    {
        $this->languageCodes = $languageCodes;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(?int $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getMobilePhones(): ?int
    {
        return $this->mobilePhones;
    }

    public function setMobilePhones(?int $mobilePhones): static
    {
        $this->mobilePhones = $mobilePhones;

        return $this;
    }

    public function getLandlinePhones(): ?int
    {
        return $this->landlinePhones;
    }

    public function setLandlinePhones(?int $landlinePhones): static
    {
        $this->landlinePhones = $landlinePhones;

        return $this;
    }

    public function getGdp(): ?int
    {
        return $this->gdp;
    }

    public function setGdp(?int $gdp): static
    {
        $this->gdp = $gdp;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): static
    {
        $this->flag = $flag;

        return $this;
    }
}
