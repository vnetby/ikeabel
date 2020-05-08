import { domStart } from "./DOM/domStart.js";
domStart();

import "@babel/polyfill";

import { domOpenModal } from "./DOM/domOpenModal.js";

import { domModal } from "./DOM/domModal.js";

import { domDropDown } from "./DOM/domDropDown.js";

import { domCarousel } from "./DOM/domCarousel.js";

import { frontHeader } from "./frontHeader.js";

import { domParallaxBg } from "./DOM/domParallaxBg.js";

import { domCustomScrollbar } from "./DOM/domCustomScrollbar.js";

import { domScrollDrag } from "./DOM/domScrollDrag.js";

import { DomFixedNav } from "./DOM/DomFixedNav.js";

import { domAccordion } from "./DOM/domAccordion.js";

import { DomCountOnScroll } from "./DOM/DomCountOnScroll.js";

import { calculator } from "./calculator/index.js";


import "../../css/dev/main.less";

const dinamicFunctions = wrap => {
  domOpenModal(wrap);
  domModal(wrap);
  domDropDown(wrap);
  domCarousel(wrap);
  frontHeader(wrap);
  domParallaxBg(wrap);
  domCustomScrollbar(wrap);
  domScrollDrag(wrap);
  domAccordion(wrap);
  new DomCountOnScroll({ calcAuto: true }, wrap);
}



const staticFunctions = wrap => {
  new DomFixedNav({
    offsetHide: '100vh'
  });
  calculator();
}




dinamicFunctions();
staticFunctions();
