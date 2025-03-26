// Sample course data (replace with your actual data)
const courses = {
  free: [
    { title: "Web Development Fundamentals", description: "Learn HTML, CSS, and JavaScript." },
    { title: "Python Basics", description: "Introduction to Python programming." },
  ],
  paid: [
    { title: "Advanced React", description: "Master React and build scalable applications." },
    { title: "Data Science with Python", description: "Learn data analysis and machine learning." },
  ],
};

// Open the side slider
document.querySelectorAll(".btn-primary").forEach((button) => {
  button.addEventListener("click", () => {
    document.getElementById("side-slider").classList.add("open");
    updateCourseList("free"); // Default to free courses
  });
});

// Close the side slider
document.getElementById("close-slider").addEventListener("click", () => {
  document.getElementById("side-slider").classList.remove("open");
});

// Update course list based on selected type
document.getElementById("course-type").addEventListener("change", (event) => {
  const type = event.target.value;
  updateCourseList(type);
});

// Function to update the course list dynamically
function updateCourseList(type) {
  const courseList = document.querySelector(".course-list");
  courseList.innerHTML = ""; // Clear existing content

  courses[type].forEach((course) => {
    const courseItem = document.createElement("div");
    courseItem.className = "course-item";
    courseItem.innerHTML = `
      <h4>${course.title}</h4>
      <p>${course.description}</p>
    `;
    courseList.appendChild(courseItem);
  });
}