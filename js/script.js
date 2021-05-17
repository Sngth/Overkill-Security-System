var gallery = {
  // (A) SHOW SELECTED IMAGE IN LIGHT BOX
  show : function(img){
    var clone = img.cloneNode(),
        front = document.getElementById("lfront"),
        back = document.getElementById("lback");

    front.innerHTML = "";
    front.appendChild(clone);
    back.classList.add("show");
  },

  // (B) HIDE THE LIGHTBOX
  hide : function(){
    document.getElementById("lback").classList.remove("show");
  }
};
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
var myVar = setInterval(myTimer, 1000);

function myTimer() {
  var d = new Date();
  document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}

