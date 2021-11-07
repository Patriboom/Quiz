# ckeditor_linkayt
Transform text into link as you type in ckeditor

As  you know, ckeditor is a very handy text editor for your web projects.
This plugin permits to your visitors to create web links while they are typing.

The actual file must be stored in
ckeditor_path/plugins/linkayt/.
like:
/home/userclientname/www/ckeditor/plugins/linkayt/plugin.js

In addition, linkayt recognize the Ctrl-Enter command as a submit command.
That means: you type text and conclude it by Ctrl-Enter instead of a click on the « Submit » button. Since then, the form is sent, the textarea is submitted as your form command expects it to be submitted.

Your comments are welcome.
Help for this little missing step is also welcome:
    I would like to remove the orginal text and replace it by the link.
    Now it gives this: « My text is here and the link comes here like http://ckedior.com ( ckeditor.com (as link) ) »
    Should be:  « My text is here and the link comes here like ckeditor.com (as link) »
