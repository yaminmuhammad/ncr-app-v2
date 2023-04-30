// add hovered class to selected list item
let list = document.querySelectorAll(".mynavigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".mytoggle");
let navigation = document.querySelector(".mynavigation");
let main = document.querySelector(".mymain");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
