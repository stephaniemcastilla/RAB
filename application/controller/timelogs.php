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
        $timelogs_model = $this->loadModel('TimeLogsModel');
        $timelogs = $timelogs_model->getAllTimeLogs();

        $stats_model = $this->loadModel('StatsModel');
        $amount_of_timelogs = $stats_model->getAmountOfTimeLogs();
        
        // load views. 
        require 'application/views/_templates/header.php';
        require 'application/views/timelogs/index.php';
        require 'application/views/_templates/footer.php';
    }
    /*
     * main function after admin 'starts' the event
     * this is where contacts and sign in and out from
     * during the event, all pages fall back to here
     */
    public function choice()
    {
        $event_id = $_GET["event"];
        
        $events_model = $this->loadModel('EventsModel');
        $info = $events_model->getInfo($event_id);

        // load views
        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/choice.php';
    }
    /*
     * function once users chooses to sign in
     * allows users to search by last name and create a time log
     * if contact is passed via url, create time log and head to confirmation page to confirm start time
     */
    public function sign_in(){
        
        $event_id = $_GET["event"];

        if(isset($_GET["contact"])){
            $contact_id = $_GET["contact"];
            $timelogs_model = $this->loadModel('TimeLogsModel');
            $id = $timelogs_model->addTimelog($contact_id, $event_id, date("Y-m-d H:i:s"), "null");
          
            header('location: ' . URL . 'timelogs/confirmin?id=' . $id . '&event=' . $event_id);
        }
        
        // load views
        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/signin.php';        
    }
    /*
     * after sign in, allows user to edit start time
     */
    public function confirmin(){

        $timelogs_model = $this->loadModel('TimeLogsModel');

        //process submission (with possible time update)
        if(isset($_POST['submitted'])){

            //TODO: validate data
            $time = $_POST['timein'];
            $date = $_POST['date'];
            $timelog_id = $_POST['id'];
            
            $timelog = $timelogs_model->getTimeLog($timelog_id);
            $timelogs_model->updateTimeLog($timelog->id, $timelog->contact_id, $timelog->event_id, $date . ' ' . $time, $timelog->time_out);
  
            $event_id = $_POST['event_id'];

            //head back to full screen choice for correct event
            header('location: ' . URL . 'timelogs/choice?event=' . $event_id );
        }

        $timelog_id = $_GET['id'];
        $event_id = $_GET['event'];
        
        $info = $timelogs_model->getTimelogAndContact($timelog_id);

        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/confirmin.php';
    }
    /*
     * once the user starts to log out, this page shows the total time logged by the user,
     * allows the users to see all their logs and update the current one
     */
    public function confirmout()
    {
        $timelogs_model = $this->loadModel('TimeLogsModel');
        
        if(isset($_POST['submitted'])){

            //TODO: validate data
            $time = $_POST['timeout'];
            $date = $_POST['date'];
            $timelog_id = $_POST['id'];
            $event_id = $_POST['event'];

            $timelog = $timelogs_model->getTimeLog($timelog_id);
            $timelogs_model->updateTimeLog($timelog->id, $timelog->contact_id, $timelog->event_id, $timelog->time_in, $date . ' ' . $time);
        }
        
        if(!isset($event_id)){
             $event_id = $_GET['event'];
        }
        if(!isset($timelog_id)){
            $timelog_id = $_GET['id'];
        }

        $timelogs = $timelogs_model->getTimeLogsForUser($timelog_id);
        $sum_time = reset($timelogs_model->getTotalTimeForUser($timelog_id));
        $firstname = reset($timelogs_model->getFirstName($timelog_id));

        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/confirmout.php';
    }
    public function sign_out()
    {

        $event_id = $_GET["event"];
        $timelogs_model = $this->loadModel('TimeLogsModel');

        if(isset($_GET['timelog'])){
            
            $timelog_id = $_GET['timelog'];
            $time_out = date("Y-m-d H:i:s"); 
            $timelog = $timelogs_model->getTimeLog($timelog_id);
            $timelogs_model->updateTimeLog($timelog->id, $timelog->contact_id, $timelog->event_id, $timelog->time_in, $time_out);
            header('location: ' . URL . 'timelogs/confirmout?id=' . $timelog_id . '&event=' . $event_id);
        }
           
        $timelogs = $timelogs_model->getOpenTimeLogsFromEvent($event_id);

        require 'application/views/_templates/fullscreen_header.php';
        require 'application/views/timelogs/signout.php';
        //TODO
        //redirect: show time logged in overlay?
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