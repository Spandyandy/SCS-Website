<?php
use App\User;

/*
 * TODO: need to test the actual controller that is
 * TODO: being used to login
 */

class LoginTest extends TestCase
{
    protected $testUser;

    /**
     * Framework method: Runs before every test case in
     * the class
     * https://phpunit.de/manual/current/en/fixtures.html
     */
    public function setUp()
    {
        $this->createApplication();
        $this->testUser = factory(User::class)->create();
        parent::setUp();
    }

    /**
     * Framework method: Runs after every test case in
     * the class
     * https://phpunit.de/manual/current/en/fixtures.html
     */
    public function tearDown()
    {
        $this->testUser->delete();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @test Ensures that when a user signs in,
     * they are directed back to the home page
     * which contains there name
     */
    public function login_see_home_page_and_users_name()
    {
        $this->login()
            ->seePageIs('/')
            ->see($this->testUser->name);
    }

    public function login()
    {
        return $this->visit('login')
            ->type($this->testUser->email, 'email')
            ->type('secret', 'password')
            ->press('Login');
        /*->seePageIs('/')
        ->see($this->testUser->name);*/
    }

    /**
     * @test Asserts that the user cannot get to the
     * login page when he/she is logged in; it will
     * redirect to the home page ('/')
     */
    public function redirect_home_if_user_signed_in()
    {
        $this->login();
        $this->visit('login')->see('/');
    }

    /**
     * @test Ensures that the user is properly
     * authenticated when user types in correct
     * credentials
     */
    /*public function check_user_is_authenticated()
    {
        $this->actingAs($this->testUser)
            ->visit('/')
            ->see($this->testUser->name);
    }*/

}