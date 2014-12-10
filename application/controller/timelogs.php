<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Timelogs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $timelogs_model = $this->loadModel('TimeLogsModel');
        $timelogs = $timelogs_model->getAllTimeLogs();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_timelogs = $stats_model->getAmountOfTimeLogs();
        
        // load views. 
        require 'application/views/_templates/header.php';
        require 'application/views/timelogs/index.php';
        require 'application/views/_templates/footer.php';
    }
    public function fullscreen()
    {   
        // load views. 
        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/fullscreen.php';
    }
    public function newTimelog()
    { 
      
      // load a model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $contacts_model = $this->loadModel('ContactsModel');
      $contacts = $contacts_model->getAllVolunteers();
      
      // load views. within the views we can echo out $contacts and $amount_of_contacts easily
      require 'application/views/_templates/header.php';
      require 'application/views/timelogs/newtimelog.php';
      require 'application/views/_templates/footer.php';
    }
    
    /**
     * ACTION: addVolunteer
     * This method handles what happens when you move to http://yourproject/volunteers/addvolunteer
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a contact" form on contacts/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to contacts/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addTimelog()
    {
        // if we have POST data to create a new contact entry
        if (isset($_POST["submit_add_timelog"])) {
            // load model, perform an action on the model
            $timelogs_model = $this->loadModel('TimeLogsModel');
            $timelogs_model->addTimelog($_POST["volunteer"], $_POST["date"], $_POST["timein"],  $_POST["timeout"], $_POST["totaltime"]);
        }

        // where to go after timelog has been added
        header('location: ' . URL . 'timelogs/');
    }
}