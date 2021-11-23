/*
 * Title: main javascript file of this project
 * Description: main file
 * Author: Samin Yasar
 * Date: 03/January/2021
 */

// DOM selection

const navLinks = document.querySelector(".navLinks");
const allLists = document.querySelector(".navLinks ul").querySelectorAll("li");
const pageLinks = allLists.length - 1;
let navLinksWidth = "";
if (pageLinks <= 3) {
  navLinksWidth = pageLinks * 10 - 5;
} else {
  navLinksWidth = pageLinks * 10 - 8;
}
navLinks.style.width = `${navLinksWidth}%`;
