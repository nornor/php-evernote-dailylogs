<?php

require 'src/autoload.php';
/**
 * Authorization Tokens are created by either:
 * [1] OAuth workflow: https://dev.evernote.com/doc/articles/authentication.php
 * or by creating a 
 * [2] Developer Token: https://dev.evernote.com/doc/articles/authentication.php#devtoken
 */
$token = 'REPLACE YOUR TOKEN HERE';
/** Understanding SANDBOX vs PRODUCTION vs CHINA Environments
 *
 * The Evernote API 'Sandbox' environment -> SANDBOX.EVERNOTE.COM 
 *    - Create a sample Evernote account at https://sandbox.evernote.com
 * 
 * The Evernote API 'Production' Environment -> WWW.EVERNOTE.COM
 *    - Activate your Sandboxed API key for production access at https://dev.evernote.com/support/
 * 
 * The Evernote API 'CHINA' Environment -> APP.YINXIANG.COM
 *    - Activate your Sandboxed API key for Evernote China service access at https://dev.evernote.com/support/ 
 *      or https://dev.yinxiang.com/support/. For more information about Evernote China service, please refer 
 *      to https://dev.evernote.com/doc/articles/bootstrap.php
 *
 * For testing, set $sandbox to true; for production, set $sandbox to false and $china to false; 
 * for china service, set $sandbox to false and $china to true.
 * 
 */
$sandbox = false;
$china   = true;
date_default_timezone_set('UTC');
$today =date("Y/m/d");
$weekarray=array("日","一","二","三","四","五","六");
$notebook = new \Evernote\Model\Notebook();
$client = new \Evernote\Client($token, $sandbox, null, null, $china);
$note         = new \Evernote\Model\Note();
$note->title  = $today." "."星期".$weekarray[date("w")];
//Using Evernote ENML 
$note->content = new \Evernote\Model\EnmlNoteContent(
    <<<ENML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE en-note SYSTEM "http://xml.evernote.com/pub/enml2.dtd">
<en-note><div><span style="background-color: rgb(255, 250, 165);-evernote-highlight:true;">WORK:</span></div><div><br/></div><div><br/></div><div><span style="background-color: rgb(255, 250, 165);-evernote-highlight:true;">LIFE:</span></div></en-note>
ENML
);
/* //Using PlainText
$note->content = new \Evernote\Model\PlainTextNoteContent('Some plain text content.');
*/
$note->tagNames = array('2017', '每日回顾');
/**
 * The second parameter $notebook is optionnal.
 * If left blank or set as null, the note will be created in the default notebook
 * Or in the App Notebook if applicable.
 *
 * Otherwise, you need to pass a \Evernote\Model\Notebook object
 * There are 2 options :
 *
 * If you already have a Notebook object (from the listNotebooks method for example)
 * just pass it as is to the method.
 *
 * If you only have a notebookGuid, instantiate an empty notebook and set the guid :
 *
 * $notebook = new \Evernote\Model\Notebook();
 * $notebook->guid = $notebook_guid;
 *
 * The notebook will be automatically retrieved if necessary
 */
$notebook = null;
$client->uploadNote($note, $notebook);