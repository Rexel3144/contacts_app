<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class notOwnerTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Temporary contact for testing
     * @var Contact 
     */
    protected $contact;

    /**
     * Temporary user which owns $this->contact
     * @var User
     */
    protected $contactOwner;

    /**
     * Temporary user which dont owns $this->contact
     * @var User
     */
    protected $notAContactOwner;

    /**
     * Set up a user and his contact
     */
    public function setUp() {
        parent::setUp();

        $this->notAContactOwner = factory('App\User')->create();
        $this->actingAs($this->notAContactOwner);
        $this->contactOwner = factory('App\User')->create();
        $this->contact = factory('App\Contact')->create(['user_id' => $this->contactOwner->id]);
    }

    /**
     * Trying to open an edit form of the contact which got an owner, as not an owner.
     * @test
     * @return void
     */
    public function openEditForm() {
        $url = '/contact/' . $this->contact->id . '/edit/part';
        $response = $this->post($url);
        $response->assertStatus(403);
    }

    /**
     * Trying to edit form of the contact which got an owner, as not an owner.
     * @test
     * @return void
     */
    public function editForm() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->put($url);
        $response->assertStatus(403);
    }

    /**
     * Trying to delete value from a cell of the contact which got an owner, as not an owner.
     * @test
     * @return void
     */
    public function deleteValueOfCell() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->patch($url);
        $response->assertStatus(403);
    }

    /**
     * Trying to the contact which got an owner, as not an owner.
     * @test
     * @return void
     */
    public function deleteContact() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->delete($url);
        $response->assertStatus(403);
    }

}
