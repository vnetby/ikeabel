const AJAX_URL = window.back_dates.ajax_url + '?action=';

const sendRequest = sets => {

  let type = sets.data ? 'POST' : 'GET';
  let action = sets.action;
  let http = new XMLHttpRequest;
  
  http.open(type, AJAX_URL + action);
  // console.log(`sendRequest ${action} ${AJAX_URL + action}` );
  if ( sets.data ) {
    http.send(sets.data);
  } else {
    http.send();
  }
  
  
  return new Promise( (resolve, reject) => {
    http.onreadystatechange = () => {
      if ( http.readyState === 4 && http.status === 200 ) {
        // console.log(`sendRequest response ${http.responseText}`);
        // console.log( sets, http.responseText );
        resolve( http.responseText );
      }
    }
  });

}







export const createFormData = dates => {
  let res = new FormData;
  for ( let key in dates ) {
    res.append(key, dates[key]);
  }
  return res;
}





export const getCalcSettings = () => {
  return new Promise ( (resolve, reject) => {
    sendRequest({
      action : 'get_calc_settings'
    })
    .then ( ( res ) => {
      res        = JSON.parse(res);
      let result = {};
      result.prices = [];
      res.prices[Object.keys(res.prices)[0]].forEach ( (item, i) => {
        result.prices.push([
          parseFloat(res.prices.ikeai_shipping_price_start[i]) || false,
          parseFloat(res.prices.ikeai_shipping_price_end[i]) || false,
          parseFloat(res.prices.ikeai_shipping_price_percent[i]) || false
        ]);
      });



      for ( let key in res ) {
        if ( key === 'prices' ) continue;
        if ( key === 'min' ) {
          result.min = parseFloat(res.min);
        }
        result[key] = res[key];
      }

      resolve( result );
    } );
  });
}









export const parseSite = dates => {
  let data = createFormData( dates );
  return new Promise ( (resolve, reject) => {
    sendRequest({
      data  : data,
      action: 'parse_site'
    })
      .then(res => {
      resolve ( res );
    });
  });
}






export const sendOrder = dates => {
  let data = createFormData({ data: JSON.stringify(dates) });
  return new Promise ( (resolve, reject) => {
    sendRequest({
      data : data,
      action: 'send_order_data'
    })
      .then(res => {
        console.log(res);
      resolve ( JSON.parse(res) );
    });
  });
}
