<?php
error_reporting(E_ERROR | E_PARSE);
//Define vars
$ftp_server = "bytelogic.gr"; // As ftp.server.com
$ftp_user_name = "bytelogi"; // As user
$ftp_password = "!F9-O}u-JRFZ"; //As password
$remoteDir = "/public_html/unisongis.eu/portal1/img/"; // As /home/user/ftp/ WITH the last slash!!
$dir = "images"; // As folder/download WITHOUT the last slash!!
function make_directory($ftp_stream, $dir){ //Create FTP directory if not exists
    // if directory already exists or can be immediately created return true
    if (ftp_chdir ($ftp_stream, $dir) || @ftp_mkdir($ftp_stream, $dir)) return true;
    // otherwise recursively try to make the directory
    if (!make_directory($ftp_stream, dirname($dir))) return false;
    // final step to create the directory
    return ftp_mkdir($ftp_stream, $dir);
}
$conn_id = ftp_connect($ftp_server); // Create FTP  Connection
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_password); //Login in with credentials
if ((!$conn_id) || (!$login_result)) { // If login fails
    echo "FTP Connection failed to server <br>\r\n";
    exit;
} else {
    echo "Connected to Server<br>\n";
}
ftp_pasv($conn_id, true); // Set Passive mode
$recursiveFileResearch = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)); // Get all files in folder and subfolder in the selected directory
$files = array();
foreach ($recursiveFileResearch as $file) {
    if ($file->isDir()){
        continue;
    }
    $files[] = str_replace($dir . "/", "", str_replace('\\', '/', $file->getPathname())); // Store the file without backslashes (Windows..) and without the root directory
}
if (count($files) > 0) {
    foreach ($files as $file) {
        //make_directory($conn_id, $remoteDir . dirname($file)); // Create directory if not exists
        ftp_chdir ($conn_id, $remoteDir . dirname($file)); // Go to that FTP directory
        echo "Current directory : " . ftp_pwd($conn_id) . " for file : " . basename($file)
            . " that could be found locally : " . $dir . "/" . $file . "<br>\n"; // Some logs to chekc the process
        ftp_put($conn_id, basename($file), $dir . "/"  . $file, FTP_BINARY); //Upload the file to current FTP directory
        echo "Uploaded " . basename($file) . "<br>\n"; // Some logs to chekc the process
    }
} else {
    echo "Didn't found any folder/files to send in directory : " . $dir . "<br>\n";
}
ftp_close($conn_id); // Close FTP Connection
echo "Finished <br>\n";

?>