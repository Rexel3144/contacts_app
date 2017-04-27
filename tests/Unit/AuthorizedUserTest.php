<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorizedUserTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Temporary user which owns $this->contact
     * @var User
     */
    protected $user;

    /**
     * Set up a user 
     */
    public function setUp() {
        parent::setUp();

        $this->user = factory('App\User')->create();
        $this->actingAs($this->user);
    }

    /**
     * Checking if authorized user can visit /login page.
     * @test
     * @return void
     */
    public function loginPage() {
        $response = $this->get('/login');
        $response->assertRedirect('/');
    }

    /**
     * Checking if authorized user can visit /register page.
     * @test
     * @return void
     */
    public function registerPage() {
        $response = $this->get('/register');
        $response->assertRedirect('/');
    }

    /**
     * Checking if authorized user can logout .
     * @test
     * @return void
     */
    public function logout() {
        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }

    /**
     * Checking if authorized user can register.
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
     * If authorized user can see his contacts.
     * @test
     * @return void
     */
    public function chechAllContacts() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Trying to open a create contact form as authorized user.
     * @test
     * @return void
     */
    public function openCreateNewContactForm() {
        $url = '/contact/create';
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    /**
     * Trying to create a contact as authorized user.
     * @test
     * @return void
     */
    public function createNewContact() {
        $url = '/contact';
        $data = [
            'name' => 'John Doe',
            'phone' => '+318238128312'
        ];
        $response = $this->post($url,$data);
        $response->assertRedirect('/');
    }

}
