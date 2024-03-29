<?php
// Include FB config file && User class
require_once 'facebook/fbConfig.php';
require_once 'facebook/User.php';

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
          // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirect the user back to the same page if url has "code" parameter in query string
    if(isset($_GET['code'])){
        header('Location: ./');
    }
    
    // Getting user facebook profile info
    try {
        $profileRequest = $fb->get('/me?fields=first_name,last_name,email');
        $fbUserProfile = $profileRequest->getGraphNode()->asArray();
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirect user back to app login page
        header("Location: ./");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Initialize User class
    $user = new User();
    
    // Insert or update user data to the database
    $fbUserData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'    => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'username'     =>  $fbUserProfile['first_name'].' '.$fbUserProfile['last_name'],
        'email'         => $fbUserProfile['email']
    );
    $userData = $user->checkUser($fbUserData);
    
    // Put user data into session
    $_SESSION['userData'] = $userData;
    
    // Get logout url
    $logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');
    
    // Render facebook profile data
    if(!empty($userData)){/*
        $output  = '<h2 style="color:#999999;">Facebook Profile Details</h2>';
        $output .= '<div style="position: relative;">';
        $output .= '</div>';
        $output .= '<br/>Facebook ID : '.$userData['oauth_uid'];
        $output .= '<br/>Name : '.$userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : '.$userData['email'];
        $output .= '<br/>Username : '.$userData['username'];
        $output .= '<br/>Logged in with : Facebook';
        $output .= '<br/>Logout from <a href="'.$logoutURL.'">Facebook</a>'; 

*/
        var_dump($userData);
/*
        $output .= $userData;
        $output .= '<br/>First Name : '.$userData['username'];
        $output .= '<br/>Last Name : '.$userData['username'];
        $output .= '<br/>Email : '.$userDataD['username'];*/

    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
}else{
    // Get login url
    $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    // Render facebook login button
    $output = '<a href="'.htmlspecialchars($loginURL).'"><img src="images/loginwithfacebook.jpg"></a>';
}
?>
<html>
<head>
<title>Login with Facebook using PHP by CodexWorld</title>
</head>
<body>
    <!-- Display login button / Facebook profile information -->
    <div><?php echo $output; ?></div>
</body>
</html>