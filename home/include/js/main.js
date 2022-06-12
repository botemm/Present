 
 function reverseString(str) {

  return str.split("").reverse().join("");

}


//Приховати показати блок
 function DisplayINV(SEL,MODE)
 {
	 if(document.querySelector(SEL))
	 if(document.querySelector(SEL).style.display == "")
		 document.querySelector(SEL).style.display = MODE;
	 else
		 document.querySelector(SEL).style.display = "";
 }
 
 function Display(SEL,MODE)
 {
	 if(document.querySelector(SEL))
	  document.querySelector(SEL).style.display = MODE;
  else
	  console.log("SEL: " + SEL + "\n");
 }
 

	function PushText(text, type, layout) {
    new Noty({
    text        : text,
    type        : type,
    dismissQueue: true,
    layout      : layout,
    theme       : 'metroui',
	timeout: 	5000,
	animation: {
        open: function (promise) {
            var n = this;
            new Bounce()
                .translate({
                    from     : {x: 450, y: 0}, to: {x: 0, y: 0},
                    easing   : "bounce",
                    duration : 1000,
                    bounces  : 4,
                    stiffness: 3
                })
                .scale({
                    from     : {x: 1.2, y: 1}, to: {x: 1, y: 1},
                    easing   : "bounce",
                    duration : 1000,
                    delay    : 100,
                    bounces  : 4,
                    stiffness: 1
                })
                .scale({
                    from     : {x: 1, y: 1.2}, to: {x: 1, y: 1},
                    easing   : "bounce",
                    duration : 1000,
                    delay    : 100,
                    bounces  : 6,
                    stiffness: 1
                })
                .applyTo(n.barDom, {
                    onComplete: function () {
                        promise(function(resolve) {
                            resolve();
                        })
                    }
                });
        },
        close: function (promise) {
            var n = this;
            new Bounce()
                .translate({
                    from     : {x: 0, y: 0}, to: {x: 450, y: 0},
                    easing   : "bounce",
                    duration : 500,
                    bounces  : 4,
                    stiffness: 1
                })
                .applyTo(n.barDom, {
                    onComplete: function () {
                        promise(function(resolve) {
                            resolve();
                        })
                    }
                });
        }
    }
	
	
	
	
  }).show();
  
  
  //Types: alert, success, warning, error, info/information
  //Layouts:top, topLeft, topCenter, topRight, center, centerLeft, centerRight, bottom, bottomLeft, bottomCenter, bottomRight
}
	
	
