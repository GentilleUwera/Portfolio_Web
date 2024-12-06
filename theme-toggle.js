// Get the button and body elements
const toggleButton = document.getElementById("toggle-theme");
const body = document.body;

// Check for the saved theme preference in localStorage
const savedTheme = localStorage.getItem("theme");
if (savedTheme) {
  body.classList.add(savedTheme);
  if (savedTheme === "dark-theme") {
    toggleButton.textContent = "Switch to Light Mode"; // Change button text
  } else {
    toggleButton.textContent = "Switch to Dark Mode"; // Default button text
  }
}

// Toggle theme on button click
toggleButton.addEventListener("click", () => {
  if (body.classList.contains("light-theme")) {
    body.classList.replace("light-theme", "dark-theme");
    toggleButton.textContent = "Switch to Light Mode";
    localStorage.setItem("theme", "dark-theme");
  } else {
    body.classList.replace("dark-theme", "light-theme");
    toggleButton.textContent = "Switch to Dark Mode";
    localStorage.setItem("theme", "light-theme");
  }
});
