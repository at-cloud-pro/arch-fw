<?php

namespace ArchFW\Controller\Interfaces;

/**
 * Interface that requires that user who used Error class will implement his own _action() method
 */
interface IError
{
    /**
     * Action which is given to user. By default it's doing nothing, but while overriding this function by inheritance user may add his own needs.
     *
     * @return void
     */
    public function action(): void;
}

