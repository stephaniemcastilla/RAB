<?php

class Contacts extends Controller
{
    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $contacts_model = $this->loadModel('ContactsModel');
        $contacts = $contacts_model->getAllContacts();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_contacts = $stats_model->getAmountOfContacts();

        // load views. within the views we can echo out $contacts and $amount_of_contacts easily
        require 'application/views/_templates/header.php';
        require 'application/views/contacts/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function addContact()
    {
        // if we have POST data to create a new contact entry
        if (isset($_POST["submit_add_contact"])) {
            // load model, perform an action on the model
            $contacts_model = $this->loadModel('ContactsModel');
            $contacts_model->addContact($_POST["photo"], $_POST["firstname"], $_POST["lastname"],  $_POST["email"], $_POST["is_volunteer"]);
        }

        // where to go after contact has been added
        header('location: ' . URL . 'contacts/index');
    }

    public function deleteContact($contact_id)
    {
        // simple message to show where you are
        //echo 'Message from Controller: You are in the Controller: Contacts, using the method deleteContact().';
        
        // if we have an id of a contact that should be deleted
        if (isset($contact_id)) {
            // load model, perform an action on the model
            $contacts_model = $this->loadModel('ContactsModel');
            $contacts_model->deleteContact($contact_id);
        }

        // where to go after contact has been deleted
        header('location: ' . URL . 'contacts/');
    }
}
