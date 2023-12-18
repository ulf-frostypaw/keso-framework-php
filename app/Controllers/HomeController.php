<?php
namespace App\Controllers;
use App\Models\ContactModel;
class HomeController extends Controller
{
    public function index()
    {
        /* $contactModel = new ContactModel();
        return $contactModel->all(); */
        return $this->view('home');
    }

}