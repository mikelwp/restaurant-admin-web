<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $message = $_POST['message'];

    $xml = new DOMDocument("1.0", "UTF-8");
    $xml->formatOutput = true;

    $filename = 'contacts.xml';

    if (file_exists($filename)) {
        $xml->load($filename);
        $root = $xml->getElementsByTagName("contacts")->item(0);
    } else {
        $root = $xml->createElement("contacts");
        $xml->appendChild($root);
    }

    $contact = $xml->createElement("contact");

    $fname = $xml->createElement("firstname", htmlspecialchars($firstname));
    $contact->appendChild($fname);

    $lname = $xml->createElement("lastname", htmlspecialchars($lastname));
    $contact->appendChild($lname);

    $msg = $xml->createElement("message", htmlspecialchars($message));
    $contact->appendChild($msg);

    $root->appendChild($contact);

    $xml->save($filename);

    echo json_encode(["status" => "success", "message" => "Data telah disimpan!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Metode pengiriman tidak valid."]);
}
?>