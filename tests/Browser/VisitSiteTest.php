<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VisitSiteTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testVisitSite()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });

    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->value('input[type="email"]', 'rbilemjian@gmail.com')
                    ->value('input[type="password"]', 'pokemon')
                    ->press('input[type="submit"]')
                    ->assertPathIs('');
        });
    }
}
