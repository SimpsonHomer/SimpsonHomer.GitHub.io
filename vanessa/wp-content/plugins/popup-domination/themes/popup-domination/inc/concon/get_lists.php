<?PHP
die('Unused code. Please contact support.');
session_start();
if(!empty($_POST['username']) && !empty($_POST['token_key']) && !empty($_POST['user_secret'])) {
    if(!class_exists('ConstantContact', true))
        require_once('ConstantContact.php');

    $username = strtolower($_POST['username']);
    $_GET['password'] = $_POST['password'];
    $apikey = $_POST['token_key'];
    $consumerSecret = $_POST['user_secret'];
    $Datastore = new CTCTDataStore();
    $DatastoreUser = $Datastore->lookupUser($username);
    if($DatastoreUser) {
        $ConstantContact = new ConstantContact('oauth', $apikey, $DatastoreUser['username'], $consumerSecret);
        $ContactLists = $ConstantContact->getLists();

        if(!empty($ContactLists)) {
            $var = '<span class="mailing-list-small">Your Constant Contact Mailing Lists</span><select class="mailing_lists" name="listsid" >';
            foreach ($lists as $list) {
                $var .= '<option name="' . $list->name . '" value="' . str_replace(array('http:', 'hhtps:'), '', $list->id) . '"> ' . $list->name . '<br />';
            }
            $var .= '</select>';
        } else
            echo '<p class="no-lists">You don\'t have any lists yet</p>';
    } else
        echo 'You are not connected, please try again';

    echo $var;
} else
    echo 'Please connect to Constant Contact using the button above before syncing your Mailing Lists.';