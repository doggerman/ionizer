<?php
declare(strict_types=1);
namespace ParagonIE\Ionizer\Contract;

/**
 * Interface FilterContainerInterface
 * @package Airship\Engine\Contract\Security
 */
interface FilterContainerInterface
{
    /**
     * @param string $path
     * @param FilterInterface $filter
     * @return self
     */
    public function addFilter(string $path, FilterInterface $filter): self;

}
