<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestTest extends TestCase {

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

//        $this->newUser = factory('App\User')->create();
//        $this->actingAs($this->newUser);
        $this->contactOwner = factory('App\User')->create();
        $this->contact = factory('App\Contact')->create(['user_id' => $this->contactOwner->id]);
    }

    /**
     * Checking if guest can visit /login page.
     * @test
     * @return void
     */
    public function loginPage() {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Checking if guest can visit /register page.
     * @test
     * @return void
     */
    public function registerPage() {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Checking if guest can logout .
     * @test
     * @return void
     */
    public function logout() {
        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }

    /**
     * Checking if guest can register.
     * @test
     * @return void
     */
    public function registerUser() {
        $data = [
            'name' => 'Test',
            'lastname' => 'Usserr',
            'email' => 'test@email.com',
            'password' => 'password1',
            'password_confirmation' => 'password1',
        ];
        $response = $this->post('/register', $data);
        $response->assertRedirect('/');
    }

    /**
     * If user not autorized he'll redirect to the login page.
     * @test
     * @return void
     */
    public function chechAllContacts() {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    /**
     * Trying to open an edit form of the contact which got an owner, as guest.
     * @test
     * @return void
     */
    public function openEditForm() {
        $url = '/contact/' . $this->contact->id . '/edit/part';
        $response = $this->post($url);
        $response->assertRedirect('/login');
    }

    /**
     * Trying to edit form of the contact which got an owner, as guest.
     * @test
     * @return void
     */
    public function editForm() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->put($url);
        $response->assertRedirect('/login');
    }

    /**
     * Trying to delete value from a cell of the contact which got an owner, as guest.
     * @test
     * @return void
     */
    public function deleteValueOfCell() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->patch($url);
        $response->assertRedirect('/login');
    }

    /**
     * Trying to the contact which got an owner, as guest.
     * @test
     * @return void
     */
    public function deleteContact() {
        $url = '/contact/' . $this->contact->id;
        $response = $this->delete($url);
        $response->assertRedirect('/login');
    }

    /**
     * Trying to open a create contact form as guest.
     * @test
     * @return void
     */
    public function openCreateNewContactForm() {
        $url = '/contact/create';
        $response = $this->get($url);
        $response->assertRedirect('/login');
    }

    /**
     * Trying to create a contact as guest.
     * @test
     * @return void
     */
    public function createNewContact() {
        $url = '/contact';
        $response = $this->post($url);
        $response->assertRedirect('/login');
    }

}
