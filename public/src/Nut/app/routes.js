var root = null;
var useHash = true;
var hash = '#!';
var router = new Navigo(root, useHash, hash);

router
  .on('/sign-in', function () {
  	console.log('test');
  })
  .resolve();