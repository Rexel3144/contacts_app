<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OwnerTest extends TestCase {

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
     * Set up a user and his contact
     */
    public function setUp() {
        parent::setUp();

        $this->contactOwner = factory('App\User')->create();
        $this->actingAs($this->contactOwner);
        $this->contact = factory('App\Contact')->create(['user_id' => $this->contactOwner->id]);
    }

    /**
     * Trying to open an edit form of the contact which got an owner, as owner.
     * @test
     * @return void
     */
    public function openEditForm() {
        $url = '/contact/' . $this->contact->id . '/edit/part';
        $data = [
            'source' => 'email',
            'value' => 'newexample@email.com'
        ];
        $response = $this->post($url, $data);
        $response->assertStatus(200);
    }

    /**
     * Trying to edit form of the contact which got an owner, as owner.
     * @test
     * @return void
     */
    public function editForm() {
        $url = '/contact/' . $this->contact->id;
        $data = [
            'email' => 'newexample@email.com',
            'source' => 'email',
            'newValue' => 'newexample@email.com'
        ];
        $response = $this->put($url, $data);
        $response->assertStatus(200);
    }

    /**
     * Trying to delete value from a cell of the contact which got an owner, as owner.
     * @test
     * @return void
     */
    public function deleteValueOfCell() {
        $url = '/contact/' . $this->contact->id;
        $data = [
            'email' => null,
            'source' => 'email',
            'newValue' => null
        ];
        $response = $this->patch($url, $data);
        $response->assertStatus(200);
    }

    /**
     * Trying to the contact which got an owner, as owner.
     * @test
     * @return void
     */
    public function deleteContact() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->delete($url);
        $response->assertStatus(200);
    }



}
