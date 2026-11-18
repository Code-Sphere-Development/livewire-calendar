<?php

namespace CodeSphere\LivewireCalendar\Tests;

use CodeSphere\LivewireCalendar\LivewireCalendarServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseCase;

class TestCase extends BaseCase
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireCalendarServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Zufaelliger Schluessel nur fuer die Testlaufzeit, Livewire braucht einen fuer Checksummen.
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }
}
