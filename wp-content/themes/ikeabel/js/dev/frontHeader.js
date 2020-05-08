import Glide from '@glidejs/glide';

const ACTIVE_SLIDER_CLASS = 'glide__slide--active';
const SLIDER_CLASS = 'glide__slide';

const ANIMATION_CLASSES = ['fadeIn', 'bounceIn', 'bounceInLeft', 'bounceInUp', 'fadeInUp', 'fadeInLeft', 'lightSpeedIn', 'rotateInUpLeft', 'slideInUp', 'slideInLeft', 'zoomIn', 'zoomInLeft', 'zoomInUp', 'rollIn', 'jackInTheBox'];

const ANIMATION_ITEM_CLASS = 'animation-item';



export const frontHeader = wrap => {
  let container = dom.getContainer(wrap);
  if (!container) return;

  let header = dom.findFirst('.js-front-header');
  if (!header) return;

  let sets = header.dataset.carouselSets;
  if (sets) {
    sets = JSON.parse(sets);
  } else {
    sets = {};
  }

  let sliders = dom.findAll(`.${SLIDER_CLASS}`, header);
  if (!sliders || !sliders.length) return;

  init({ header, sets, sliders });
}




const init = ({ header, sets, sliders }) => {

  
  let slider = new Glide(header, sets);
  
  slider.on('mount.after', () => {
    dom.css(header, { opacity: 1 });
    animateSlider({ slider: sliders[0] });
    setTimeout(() => {
      dom.removeClass(header, 'opacity-load');
    }, 500);
  });

  slider.on('run.after', (params) => {
    hideAllSliders({ sliders });
    let current = getCurrentSlider({ sliders });
    animateSlider({ slider: current });
  });

  slider.mount();
  // slider.play(3000);

}





const getCurrentSlider = ({ sliders }) => {
  for (let i = 0; i < sliders.length; i++) {
    if (sliders[i].classList.contains(ACTIVE_SLIDER_CLASS)) {
      return sliders[i];
    }
  }
}





const hideAllSliders = ({ sliders }) => {
  sliders.forEach(slider => {
    let item = dom.findFirst(`.${ANIMATION_ITEM_CLASS}`, slider);
    if (!item) return;
    dom.removeClass(item, 'animated ' + ANIMATION_CLASSES.join(' '));
  });
}





const animateSlider = ({ slider }) => { 
  let animItem = dom.findFirst(`.${ANIMATION_ITEM_CLASS}`, slider);
  if (!animItem) return;
  let animClass = ANIMATION_CLASSES[Math.floor(Math.random() * ANIMATION_CLASSES.length)];
  dom.addClass(animItem, `${animClass} animated`);
}


