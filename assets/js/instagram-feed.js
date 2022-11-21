const pageSidePadding = 10;
const imagesGap = 10;

console.log(window.innerWidth)

const RESPONSIVE_WIDTH = {
  DESKTOP: 1441,
  TABLET: 1024,
  MOBILE: 768,
};

const carousel = document.getElementById("instagram-feed-carousel");

const removeElementorPadding = (carousel) => {
  const elementorContainer = carousel.parentElement.parentElement.parentElement.parentElement;
  elementorContainer.style.padding = 0;
}

const resizeImages = (carousel) => {
  const width = innerWidth;
  const imagesTotal = carousel.dataset.count;

  let imagesCount = 7;
  if (width <= RESPONSIVE_WIDTH.MOBILE) {
    imagesCount = 2;
  } else if (width < RESPONSIVE_WIDTH.TABLET) {
    imagesCount = 3;
  } else if (width < RESPONSIVE_WIDTH.DESKTOP) {
    imagesCount = 5;
  }

  const containerWidth = width - 2 * pageSidePadding;
  const imageWidth =
    ((containerWidth - (imagesCount - 1) * imagesGap) / imagesCount) + 1;

  carousel.style.width = `${imagesTotal * (imageWidth + imagesGap) - 10}px`;

  for (let i = 0; i < carousel.children.length; i++) {
    const imageContainer = carousel.children[i];
    imageContainer.style.width = `${imageWidth}px`;
  }

  console.log("FINISHED");
};

resizeImages(carousel);
removeElementorPadding(carousel);

addEventListener("resize", () => resizeImages(carousel));
