import '../css/app.scss';
// assets/app.js

import '@fortawesome/fontawesome-free/css/all.css';



document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".rating .star");
    const ratingValue = document.getElementById("rating-value");

    stars.forEach((star) => {
        star.addEventListener("mouseover", () => {
            const rating = star.getAttribute("data-rating");
            stars.forEach((s) => {
                if (s.getAttribute("data-rating") <= rating) {
                    s.classList.add("hover");
                } else {
                    s.classList.remove("hover");
                }
            });
        });

        star.addEventListener("mouseout", () => {
            stars.forEach((s) => {
                s.classList.remove("hover");
            });
        });

        star.addEventListener("click", () => {
            const rating = star.getAttribute("data-rating");
            ratingValue.value = rating;

            stars.forEach((s) => {
                if (s.getAttribute("data-rating") <= rating) {
                    s.classList.add("active");
                } else {
                    s.classList.remove("active");
                }
            });
        });
    });
});

