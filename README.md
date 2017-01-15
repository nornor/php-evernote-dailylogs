# php-evernote-dailylogs
A simple demo that creates Evernote notes using the evernote's developer token. I use this script with linux cronb to create dairy titled as "YYYY/MM/DD 星期X"

**Attention**

Developer tokens are available for the Evernote sandbox and production services. But in this case,the codes are for the production service.

##PHP PART

###1/Get Your Developer Token

**For Evernote International(国际版用户)**:https://www.evernote.com/api/DeveloperToken.action

**For Evernote China(印象笔记用户)**:https://dev.yinxiang.com/doc/articles/dev_tokens.php

###2/Replace the token
`$token = 'REPLACE YOUR TOKEN HERE';`
