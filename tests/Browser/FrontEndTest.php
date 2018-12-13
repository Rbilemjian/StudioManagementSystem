<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan as Artisan;

class FrontEndTest extends DuskTestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testVisitSite()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->waitForText('Payment Logger')
                    ->assertSee('Payment Logger');
        });

    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('input[type="email"]', 'professor@example.com')
                    ->type('input[type="password"]', 'password')
                    ->press('input[type="submit"]')
                    ->assertDontSee('Wrong email or password');
        });
    }

    public function testHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->waitForText('Welcome to Payment Logger')
                    ->assertSee('Welcome to Payment Logger');
        });
    }

    public function testPaymentPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/payments')
                    ->waitForText('Payments View')
                    ->assertSee('Payments View');
        });
    }

    public function testNewPayment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/payments')
                    ->waitForLink('New Payment')
                    ->assertSee('New Payment')
                    ->clickLink('New Payment')
                    ->waitForLink('Cancel')
                    ->assertSee('Cancel');
        });
    }

    public function testNavLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->waitForLink('Professor')
                    ->assertSee('Professor')
                    ->clickLink('Professor')
                    ->waitForLink('Logout')
                    ->assertSee('Logout')
                    ->clickLink('Logout')
                    ->waitForText('Login')
                    ->assertSee('Login');
        });
    }
}
