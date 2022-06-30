<?php


namespace Wialon\Notification;


interface ControlTypeInterface
{
    /**
     * @deprecated
     * @return string
     */
    public function getTrg(): string;

    public function getArrayAttributes(): array;
}
