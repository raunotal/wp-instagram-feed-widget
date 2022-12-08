const PAGE_SIDE_PADDING = 10;
const IMAGES_GAP = 15;
const CAROUSEL_SPEED = 3000;

const RESPONSIVE_WIDTH = {
  DESKTOP: 1441,
  TABLET: 1024,
  MOBILE: 768,
};

const carousel = document.getElementById("instagram-feed-carousel");

let interval;

const activateCarousel = (carousel, imageWidth, imagesTotal, imagesCount) => {
  let position = 0;
  let count = 0;
  interval = setInterval(() => {
    if (count === imagesTotal - imagesCount) {
      position = 0;
      count = 0;
    } else {
      position -= imageWidth + IMAGES_GAP;
      count++;
    }
    carousel.style.transform = `translate3d(${position}px, 0px, 0px)`;
  }, CAROUSEL_SPEED);
};

const resizeImages = (carousel) => {
  if (!carousel) {
    return;
  }
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

  const containerWidth = width - 2 * PAGE_SIDE_PADDING;
  const imageWidth = Math.round(
    (containerWidth - (imagesCount - 1) * IMAGES_GAP) / imagesCount
  );
  const carouselWidth = imagesTotal * (imageWidth + IMAGES_GAP) - 10;

  carousel.style.width = `${carouselWidth}px`;

  for (let i = 0; i < carousel.children.length; i++) {
    const imageContainer = carousel.children[i];
    imageContainer.style.width = `${imageWidth}px`;
  }

  if (interval) {
    clearInterval(interval)
  }

  activateCarousel(carousel, imageWidth, imagesTotal, imagesCount);
};

resizeImages(carousel);
addEventListener("resize", () => resizeImages(carousel));
