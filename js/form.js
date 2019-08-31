// set variables to use in if logic later in code
let yes = document.getElementById("yes").addEventListener("click", insertFORM);
let no = document.getElementById("no").addEventListener("click", insertNO);

// logic for back button on form to hide form and show radio btns
document.querySelector("#form-back").addEventListener("click", function() {
  var x = document.getElementById("hide-this");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
  document.getElementById("show-this").setAttribute("hidden", true);
});

// logic for back button on nothing to do section
document.querySelector("#nothing-back").addEventListener("click", function() {
  var x = document.getElementById("hide-this");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
  document.getElementById("nothing-to-do").setAttribute("hidden", true);
});

// logic to hide radio btns on checked choice and show form by removing hidden attr
function insertFORM() {
  var x = document.getElementById("hide-this");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  document.getElementById("show-this").removeAttribute("hidden");
  document.getElementById("yes").checked = false;
}

// Go to next radio button choice
function insertNO() {
  var x = document.getElementById("hide-this");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  document.getElementById("next-radio-btn").removeAttribute("hidden");
  document.getElementById("no").checked = false;
}

// Make a decision on what function about to run
// needs work
if (yes) {
  insertFORM();
} else if (no) {
  insertNO();
}
