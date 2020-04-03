/*
 * Show snackbar on load
 */
function showSnackbar() {
  var snackbar = document.getElementById("snackbar");
  var dismiss = document.getElementById("snackbar_dismiss");
  snackbar.className = "show";
  dismiss.addEventListener("click", function() {
    snackbar.classList.add("hide_snackbar");
  });
  // setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
}

// Store snackbar in session storage to display only once per user
jQuery(document).ready(function($) {
  if (sessionStorage.getItem("#snackbar") !== "true") {
    showSnackbar();
    sessionStorage.setItem("#snackbar", "true");
  }
});
