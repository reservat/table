<?php

namespace Reservat;

use Reservat\Core\Interfaces\EntityInterface;
use Reservat\Interfaces\TableInterface;

class Table implements TableInterface, EntityInterface
{

    protected $number = null;
    protected $capacity = null;
    protected $venueId = null;
    protected $isFixed = null;

    public function __construct($number, $capacity, $venueId, $isFixed)
    {
        $this->number = $number;
        $this->capacity = $capacity;
        $this->venueId = $venueId;
        $this->isFixed = $isFixed;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setCapacity($number)
    {
        $this->capacity = $number;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setVenue($venue)
    {
        $this->venueId = $venue;
    }

    public function getVenue()
    {
        return $this->venueId;
    }

    public function setIsFixed($isFixed)
    {
        $this->isFixed = $isFixed;
    }

    public function getIsFixed()
    {
        return $this->isFixed;
    }

    public function toArray()
    {
        return [
            'number' => $this->number,
            'capacity' => $this->capacity,
            'venue_id' => $this->venueId,
            'isFixed' => $this->isFixed
        ];
    }

    public static function createFromArray(array $data)
    {
        return new static($data['number'], $data['capacity'], $data['venue_id'], $data['isFixed']);
    }
}
