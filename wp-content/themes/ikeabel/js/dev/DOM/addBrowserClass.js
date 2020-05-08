const { detect } = require('detect-browser');
const browser = detect();
import { isMobile, isTablet, deviceDetect } from 'mobile-device-detect';

import "./css/addBrowserClass.less";



const BROWSER_CLASSES = {
  ie: 'browser-ie',
  chrome: 'browser-chrome',
  firefox: 'browser-firefox',
  edge: 'browser-edge'
}

const ORIENTATION_CLASSES = {
  'jshelper-orientation-potrait': 'orientation-potrait',
  'jshelper-orientation-landscape': 'orientation-landscape'
}

const TOUCH_CLASSES = {
  'jshelper-touch': 'touch',
  'jshelper-notouch': 'notouch'
}



export const addBrowserClass = () => {
  initHelpers();

  initDeviceDetect();

  window.browserDetect = browser.name;
  let className = BROWSER_CLASSES[browser.name] ? BROWSER_CLASSES[browser.name] : BROWSER_CLASSES['chrome'];
  document.body.classList.add(className);
}





const initDeviceDetect = () => {
  let className = 'device-desktop';
  if (isMobile) {
    className = 'device-mobile';
  }
  if (isTablet) {
    className = 'device-tablet';
  }
  dom.removeClass(dom.body, 'device-desktop device-mobile device-tablet');
  dom.addClass(dom.body, className);
}


const initHelpers = () => {
  let wrap = document.createDocumentFragment();

  wrap.appendChild(createHelper({ helperClass: 'orientation', names: ORIENTATION_CLASSES }));

  wrap.appendChild(createHelper({ helperClass: 'touch', names: TOUCH_CLASSES }));

  // wrap.appendChild(createHelper({ helperClass: 'device-type', names: DEVICE_TYPE_CLASSES }));

  dom.body.appendChild(wrap);
}



const createHelper = ({ helperClass, names }) => {
  let target = dom.create('span', `js-helper js-helper-${helperClass}`);
  observeHelper({ target, names });
  return target;
}



const observeHelper = ({ target, names }) => {
  target.addEventListener('animationstart', e => {
    setBodyClass({ names, e });
  });
}



const setBodyClass = ({ names, e }) => {
  dom.removeClass(dom.body, Object.values(names).join(' '));
  dom.addClass(dom.body, names[e.animationName]);
}

