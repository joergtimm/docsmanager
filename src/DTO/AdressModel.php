<?php

namespace App\DTO;

class AdressModel
{
    public function __construct(
        ?string $country = null,
        ?string $city = null,
        ?string $street = null,
        ?string $housenumber = null,
        ?string $zipcode = null
    ) {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->zipcode = $zipcode;
    }

    public ?string $country = null;

    public ?string $city = null;

    public ?string $street = null;

    public ?string $housenumber = null;

    public ?string $zipcode = null;


    public function getFullAddress(): string
    {
        return sprintf(
            '%s, %s, %s %s, %s',
            $this->street,
            $this->housenumber,
            $this->zipcode,
            $this->city,
            $this->country
        );
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getHousenumber(): ?string
    {
        return $this->housenumber;
    }

    public function setHousenumber(?string $housenumber): void
    {
        $this->housenumber = $housenumber;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }
}
