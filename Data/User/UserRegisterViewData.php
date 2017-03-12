<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 17:03
 */

namespace Data\User;


use Data\Cities\City;
use Data\Countries\Country;
use Data\Genders\Gender;
use Data\Orientations\Orientation;

class UserRegisterViewData
{
    /** @var  Gender[]\Generator */
    private $genders;

    /** @var  City[]\ Generator */
    private $cities;

    /** @var  Country[]\ Generator */
    private $countries;

    /** @var  Orientation[]\ Generator */
    private $orientations;

    /**
     * @return Gender[]\ Generator
     */
    public function getGenders()
    {
        return $this->genders;
    }

    /**
     * @param callable $genders
     */
    public function setGenders(callable $genders)
    {
        $this->genders = $genders();
    }

    /**
     * @return City[]\ Generator
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param callable $cities
     */
    public function setCities(callable $cities)
    {
        $this->cities = $cities();
    }

    /**
     * @return Country[]\ Generator
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param callable $countries
     */
    public function setCountries(callable $countries)
    {
        $this->countries = $countries();
    }

    /**
     * @return Orientation[]\ Generator
     */
    public function getOrientations()
    {
        return $this->orientations;
    }

    /**
     * @param callable $orientations
     */
    public function setOrientations(callable $orientations)
    {
        $this->orientations = $orientations();
    }




}