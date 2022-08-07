// cacher les formulaires
document.querySelectorAll(".cancel").forEach((button) => {
  button.addEventListener("click", () => {
    button.parentElement.parentElement.classList.add("hidden");
  });
});

// révéler les formulaires
const revealForm = (trigger, target) => {
  document.getElementById(trigger).addEventListener("click", () => {
    document.getElementById(target).classList.remove("hidden");
  });
};

revealForm("reveal_confirm_deleteFlight", "confirm_deleteFlight");

console.log(document.getElementById("reveal_confirm_deleteFlight"));
console.log(document.getElementById("confirm_deleteFlight"));
