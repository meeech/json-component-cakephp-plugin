A CakePHP plugin to have your app respond with JSON(P).

Still under development, but using it in a project so wanted some easy access.

More detailed instructions to come. Source is commented, so start there if you need it.

If you are using jsonp, you will need to turn on 

Router::parseExtensions('json');

and make sure the url you hit ends in .json

This will probably change in the future (will key it off callback params being set - this will remove need for parse extensions)
