<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 19/02/2015
 * Time: 09:54
 */
use Symfony\Component\DomCrawler\Crawler;


class LoginUserTest extends TestCase implements LoginInterface{

    protected $listener = null;
    protected $email = null;
    protected $pass = null;
    protected  $manager;
    protected $officer;


    public function __construct()
    {

        $this->listener = new LoginUser();
        $this->manager = 'admin@admin.com';
        $this->officer = 'off@off.com';
        $this->pass = 'asdf123';

        $this->email = $this->officer;

    }
    /**
     * Login Check
     */
    public function testLogin()
    {
        $this->listener->login($this, $this->email, $this->pass);

        $this->assertSessionHas('email', $this->email);

        if(Session::get('role') == 'manager'){
            echo "Logged in as Program Manager"."\r\n";

            $crawler = $this->client->request('GET', 'admin');
            $this->assertTrue($this->client->getResponse()->isOk());
            $this->assertEquals(1, $crawler->filter('.header-admin-role-text:contains("Programme Manager")')->count());


        }else{
            echo "Logged in as Project Officer"."\r\n";

            $crawler = $this->client->request('GET', 'officer');
            $this->assertTrue($this->client->getResponse()->isOk());
            $this->assertEquals(1, $crawler->filter('.header-admin-role-text:contains("Project Officer")')->count());

        }
    }


    public function loginSuccessful(){
        $this->assertTrue(true);
    }

    public function loginFailed(){
        $this->assertTrue(false);
    }

    public function testLoginController(){

       // $crawler = $this->client->request('POST', 'SessionsController@login');

      //  $this->assertTrue($this->client->getResponse()->isOk());
        $response = $this->action('GET', 'PagesController@index');
        $view = $response->original;

        $this->assertEquals('Tech4i2', $view['pages.login']);

    // $response = $this->action('POST', 'SessionsController@login', array('user' => 1));
    }







}