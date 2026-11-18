<?php

namespace CodeSphere\LivewireCalendar\Tests;

use Carbon\Carbon;
use CodeSphere\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class LivewireCalendarRenderingTest extends TestCase
{
    public function test_navigation_keeps_end_of_month_across_short_months()
    {
        $component = Livewire::test(LivewireCalendar::class, [
            'initialYear' => 2025,
            'initialMonth' => 3,
        ]);

        $component->call('goToPreviousMonth');
        $this->assertEquals(Carbon::create(2025, 2, 28), $component->get('endsAt'));

        $component->call('goToPreviousMonth');
        $this->assertEquals(Carbon::create(2025, 1, 1), $component->get('startsAt'));
        $this->assertEquals(Carbon::create(2025, 1, 31), $component->get('endsAt'));

        $component->call('goToNextMonth');
        $component->call('goToNextMonth');
        $this->assertEquals(Carbon::create(2025, 3, 31), $component->get('endsAt'));
    }

    public function test_grid_covers_full_weeks_with_monday_start()
    {
        $component = Livewire::test(LivewireCalendar::class, [
            'initialYear' => 2025,
            'initialMonth' => 6,
            'weekStartsAt' => Carbon::MONDAY,
        ]);

        $this->assertEquals(Carbon::create(2025, 5, 26), $component->get('gridStartsAt')->startOfDay());
        $this->assertEquals(Carbon::create(2025, 7, 6), $component->get('gridEndsAt')->startOfDay());
        $this->assertCount(6, $component->instance()->monthGrid());
    }

    public function test_renders_events_on_their_day()
    {
        Livewire::test(CalendarWithEvents::class, [
            'initialYear' => 2025,
            'initialMonth' => 6,
        ])
            ->assertSee('Breakfast')
            ->assertSee('Pancakes')
            ->assertSee('wire:click="onDayClick(2025, 6, 15)"', false);
    }

    public function test_click_handlers_can_be_disabled()
    {
        Livewire::test(CalendarWithEvents::class, [
            'initialYear' => 2025,
            'initialMonth' => 6,
            'dayClickEnabled' => false,
            'eventClickEnabled' => false,
        ])
            ->assertDontSee('onDayClick(', false)
            ->assertDontSee('onEventClick(', false);
    }

    public function test_views_are_registered_under_package_namespace()
    {
        $this->assertTrue(view()->exists('livewire-calendar::calendar'));
        $this->assertTrue(view()->exists('livewire-calendar::day'));
        $this->assertTrue(view()->exists('livewire-calendar::day-of-week'));
        $this->assertTrue(view()->exists('livewire-calendar::event'));
    }

    public function test_scripts_directive_is_registered()
    {
        $compiled = Blade::compileString('@livewireCalendarScripts');

        $this->assertStringContainsString('function onLivewireCalendarEventDrop', $compiled);
        $this->assertStringContainsString("call('onEventDropped'", $compiled);
    }
}

class CalendarWithEvents extends LivewireCalendar
{
    public function events(): Collection
    {
        return collect([
            [
                'id' => 1,
                'title' => 'Breakfast',
                'description' => 'Pancakes',
                'date' => Carbon::create(2025, 6, 15, 8),
            ],
        ]);
    }
}
