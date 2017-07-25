<?php
namespace AUTH\Types\Base;

/**
 * Interface SessionAuthInterface
 * @package AUTH\Types\Interfaces
 */
interface SessionAuthInterface {
    /**
     * @return mixed
     */
    public function checkAuth();
}