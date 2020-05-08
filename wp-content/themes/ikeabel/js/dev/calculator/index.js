import React from 'react';
import ReactDOM from 'react-dom';

import {ShipCalculator} from './ShipCalculator.js';



export const calculator = () => {
  if ( document.querySelector('#shippingCalculator') ) {
    ReactDOM.render( <ShipCalculator />, document.querySelector('#shippingCalculator') );
  }
}
