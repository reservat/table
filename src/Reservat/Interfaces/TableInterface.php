<?

namespace Reservat\Interfaces;

interface TableInterface
{
	public function getNumber();
	public function getCapacity();
	public function getVenue();
	public function getIsFixed();
}