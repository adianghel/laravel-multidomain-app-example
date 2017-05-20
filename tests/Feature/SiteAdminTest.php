<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteAdminTest extends TestCase
{
    /**
     * Test open site admin panel
     *
     * @dataProvider siteDomainsProvider
     * @return void
     */
    public function testOpenSiteAdminPanel($hostname)
    {
        $response = $this->get("http://{$hostname}/manager");

        $response->assertStatus(200);
        $response->assertSee("Admin panel of site {$hostname}");
    }

    /**
     * Site domains provider
     *
     * @return array
     */
    public function siteDomainsProvider()
    {
        return [[
                'site-1-foo.com'
            ], [
                'site-2-bar.com'
            ], [
                'site-3-baz.com'
            ],
        ];
    }
}