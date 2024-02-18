<?php
declare(strict_types=1);

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Database\Seeds\ExampleSeeder;
use Tests\Support\Models\ExampleModel; 
/**
 * @internal
 */
final class loginUnitTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    /** @test */
   

    public function test_user_can_view_a_login_form()
    {
        $result =  $this->call('get','/login');
        $result->assertSee("Login");
        $result->assertSee("Email Address");
        $result->assertSee("Password");
        $result->assertSee("Remember me"); 
    } 
    /**
     * Check for dashboard login
     */
    public function test_signin_functionality(){
        
        $result = $this->call('post','/login',[
            "email" => env("TEST_USER_EMAIL"),
            "password" => env("TEST_USER_PASSWORD"),
            "csrf_test_name" => csrf_field(),
            "remember" => false,
        ]);

        $result->assertRedirectTo('/home');
        $result->assertSessionHas('user', ["id"=>1]);
    }
    public function test_logout(){
        $result = $this->call('get',"/logout");
        
        $result->assertRedirectTo("/login");
       
    }

    public function test_wrong_credentials(){ 
        $result = $this->call('post','/login',[
            "email" => "sonirobin239@gmail.com",
            "password" => "randome password",
            "csrf_test_name" => csrf_field(),
            "remember" => false,
        ]); 
        $result->assertRedirectTo('/login_failure');
    }
    public function test_login_failure_page(){
        $result = $this->call("get","/login_failure");
        $result->assertSeeLink("Register");
        $result->assertSeeLink("Use a Login Link");
    }

     
}