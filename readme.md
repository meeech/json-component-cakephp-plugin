A CakePHP plugin to have your app respond with JSON(P).

Still under development, but using it in a project so wanted some easy access.

More detailed instructions to come. Source is commented, so start there if you need it.

If you are using jsonp, make sure your request comes in with query param of callback

ie: http://www.example.com/users/view/1?callback=Name.of.callback

The json.ctp fragment is setup to be aware of if it needs to wrap the response in the callback.

Expectations:

* That a variable, $output , is set for the view. This is what we will output as json
* If you create a view/elements/json.ctp the component will use that instead. So you can customize that according to your needs.
Otherwise, it uses the one bundled in the plugin. 
* Assumes you have the default views/layouts/ajax.ctp in your app. 


 