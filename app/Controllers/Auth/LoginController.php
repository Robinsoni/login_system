<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use CodeIgniter\Shield\Controllers;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules; 

class LoginController extends BaseController
{
    
     
    public function loginAction()
    {
        
        echo "I'm logged in already <pre>" ;
        print_r(session());
        die(" yes logged in");
         /* if(!auth()->loggedIn()){
        }  */
        
    }
     

}
