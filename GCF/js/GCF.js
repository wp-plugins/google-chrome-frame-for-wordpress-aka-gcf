 
     // The conditional ensures that this code will only execute in IE,
     // Therefore we can use the IE-specific attachEvent without worry
     window.attachEvent("onload", function() {
    	 document.body.setAttribute('id','prompt');
       CFInstall.check({
         mode: "inline", // the default
         node: "prompt"
       });
     });

