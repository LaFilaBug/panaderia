/**
 * @Authors: Laura, Daniel, Ivan, Alejandro, Adrian.
 * @github: https://github.com/TuniversEquipo3/ejercicio-panaderia
 */

document.querySelector("#content1-headline1").style.fontSize = "1.0em";
document.querySelector("#content1-headline2").style.fontSize = "1.0em";
document.querySelector("#content1-headline3").style.fontSize = "1.0em";
document.querySelector("#content2-1").style.fontSize = "2.0em";
document.querySelector("#content2-2").style.fontSize = "2.0em";
document.querySelector("#footer1").style.fontSize = "1.2em";
document.querySelector("#footer2").style.fontSize = "1.2em";
document.querySelector("#footer3").style.fontSize = "1.2em";



window.addEventListener("resize", function () {
  if (document.documentElement.clientWidth <= 430) {
    $(".navbar-brand").html("<img src='https://res.cloudinary.com/dbqqjaqqa/image/upload/v1489761620/logo_mini_pou3vz.png'>");
  } else {
    $(".navbar-brand").html("<img src='https://res.cloudinary.com/dbqqjaqqa/image/upload/v1489836162/smaller_size_logo_wigzr1.png'>");
  }
});

