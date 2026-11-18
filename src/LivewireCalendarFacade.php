<?php

namespace CodeSphere\LivewireCalendar;

use Illuminate\Support\Facades\Facade;

/**
 * @see LivewireCalendar
 */
class LivewireCalendarFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'livewire-calendar';
    }
}
