<?php
namespace AUTH\Types\Interfaces;

interface SessionAuthInterface {
    /**
     * @return mixed
     */
    public function checkAuth();
}