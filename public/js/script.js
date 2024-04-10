const containers = document.querySelectorAll(".container-fluid");
window.addEventListener("scroll", function () {
  containers.forEach((container) => {
    const containerTop = container.getBoundingClientRect().top;
    const isInViewPort =
      containerTop < window.innerHeight * 0.8 &&
      containerTop + container.offsetHeight * 0.8 > 0;
    container.classList.toggle("show", isInViewPort);
  });
});