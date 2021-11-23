// Product image zoomming start

// select all elements

const imgContainer = document.querySelector(".img-container");
const productImg = document.getElementById("product_img");

// variables

let zoomLevel = undefined;
// let zoomLevel = 2;

// eventlistener

imgContainer.addEventListener("mousemove", (e) => {
  const x = e.offsetX;
  const y = e.offsetY;
  zoomLevel = 4;
  document.body.style.cursor = "zoom-in";
  productImg.style.transformOrigin = `${x}px ${y}px`;
  productImg.style.transform = `scale(${zoomLevel})`;
});

imgContainer.addEventListener("mouseleave", () => {
  document.body.style.cursor = "default";
  productImg.style.transformOrigin = `center center`;
  productImg.style.transform = `scale(1)`;
});

// Product image zoomming end

// Product star rating start

const iconContainer = document.querySelector(".review-submit-rating-icon");
const allIcons = document
  .querySelector(".review-submit-rating-icon")
  .querySelectorAll("i.fa-star");
const ratingInput = document.querySelector(".rating-input");

for (let i = 0; i < allIcons.length; i++) {
  allIcons[i].countStar = i + 1;
  allIcons[i].allEvents = ["click", "mouseover", "mouseout"];
  allIcons[i].allEvents.forEach((e) => {
    allIcons[i].addEventListener(e, markStar);
  });
}

let isClicked = false;
function markStar(e) {
  let eventType = e.type;
  let countStar = this.countStar;
  let countRating = 0;
  allIcons.forEach((element, index) => {
    if (eventType == "click") {
      isClicked = true;
      if (index < countStar) {
        element.classList.value = "fa fa-star";
      } else {
        element.classList.value = "far fa-star";
      }
      countRating = countStar;
      ratingInput.value = countRating;
    } else if (eventType == "mouseover") {
      isClicked = false;
      if (index < countStar) {
        element.classList.value = "fa fa-star";
      } else {
        element.classList.value = "far fa-star";
      }
    } else if (eventType == "mouseout") {
      if (isClicked == false) {
        element.classList.value = "far fa-star";
      }
    }
  });
}

// Product star rating end
