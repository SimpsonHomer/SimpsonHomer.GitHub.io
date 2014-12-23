<?PHP
if(!class_exists('FullNameParser'))
    require('name_parser.php');

$mailing_data = $this->get_db('popdom_mailing', 'id="' . preg_replace("/[^0-9]/","", $_POST['mailingid']) . '"');

if(empty($mailing_data))
    die('Mailing List Error');

$mailing_info = unserialize(base64_decode($mailing_data[0]->settings));

if(empty($mailing_info['provider_details']) || empty($mailing_info['provider_details']['cc_access']))
    die('Mailing List Error');

require_once 'Ctct/autoload.php';

use Ctct\ConstantContact;
use Ctct\Components\Contacts\Contact;
use Ctct\Components\Contacts\ContactList;
use Ctct\Components\Contacts\EmailAddress;
use Ctct\Exceptions\CtctException;

define('APIKEY', '3psaz7mf73gy9rhtjqxc7ygp');
define('ACCESS_TOKEN', $mailing_info['provider_details']['cc_access']);

$cc = new ConstantContact(APIKEY);

/* Attempt to fetch lists in the account, catching any exceptions and printing the errors to screen */
try{
    $lists = $cc->getLists(ACCESS_TOKEN);
} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
        print_r($error);
    }
}

/* Check if the form was submitted */
if (isset($_POST['email']) && strlen($_POST['email']) > 1) {
    $action = 'Getting Contact By Email Address';
    try {
        /* Check to see if a contact with the email address already exists in the account */
        $response = $cc->getContactByEmail(ACCESS_TOKEN, $_POST['email']);

        /* Create a new contact if one does not exist */
        if(empty($response->results)) {
            $contact = new Contact();
            $contact->addEmail($_POST['email']);
        } else
            $contact = $response->results[0];

        $contact->addList($_POST['listid']);

        $parser = new FullNameParser();
        $split_name = $parser->split_full_name($_POST['name']);

        if(!empty($split_name['fname']))
            $contact->first_name = $split_name['fname'];

        if(!empty($split_name['lname']))
            $contact->last_name = $split_name['lname'];

        if(empty($response->results))
            $returnContact = $cc->addContact(ACCESS_TOKEN, $contact);
        else
            $returnContact = $cc->updateContact(ACCESS_TOKEN, $contact);

        // catch any exceptions thrown during the process and print the errors to screen
    } catch (CtctException $ex) {
        /*
        echo '<span class="label label-important">Error '.$action.'</span>';
        echo '<div class="container alert-error"><pre class="failure-pre">';
        print_r($ex->getErrors());
        echo '</pre></div>';
        */
        die('Unknown error occurred. Please contact support.');
    }
}

if(isset($returnContact)) {
    /*
    echo '<div class="container alert-success"><pre class="success-pre">';
    print_r($returnContact);
    echo '</pre></div>';
    */
}