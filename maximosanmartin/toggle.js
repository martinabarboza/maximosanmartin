var toggle = document.getElementById("container");
var body = document.querySelector("body");
var header = document.querySelector("header");
var footer = document.querySelector("footer");

toggle.onclick = function () {
  toggle.classList.toggle("active");
  body.classList.toggle("active");
  header.classList.toggle("active");
  footer.classList.toggle("active");
};
