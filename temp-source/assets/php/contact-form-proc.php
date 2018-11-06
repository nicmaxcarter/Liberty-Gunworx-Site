<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_POST['email'])) {

    // EDIT THE 4 LINES BELOW AS REQUIRED
    $email_to = "libertygunworx@gmail.com, mike@libertygunworx.com";
    $email_display = "forms@codobit.com";
    $email_subject = "New Form Submission!";
    $email_bcc = "codobitdev@gmail.com";

    // Form components
    $name = $_POST['name'];
    $email_from = $_POST['email'];
    $message = $_POST['message'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    // This is the formatting for the message sent via email

    $email_message = "Submission to your contact form on libertygunworx.com.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email_from) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

// create email headers
    $headers = 'From: ' . $email_display . "\r\n" .
    'Reply-To: ' . $email_from . "\r\n" .
    'BCC: ' . $email_bcc . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    // Redirect to a thank you page
    header('Location: ../../thank-you.html');
    ?>



Thank you for contacting us. We will be in touch with you very soon.

<?php

}
?>