<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        if(!auth()->loggedIn()){
            return redirect()->to(base_url("login"));
        } 
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
         
    }
}