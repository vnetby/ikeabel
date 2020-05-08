import React from 'react';
import { Preloader, AddCalcRow, CalcRow, CalcRowHead, OrderForm } from './components';
import { getCalcSettings, parseSite, sendOrder } from './server';





export class ShipCalculator extends React.Component {



  constructor(props) {
    super(props);


    this.total = 0;

    this.totalShip = 0;

    this.defState = {
      load: true,
      parseLink: false,
      instructions: null,
      message: null,
      orderForm: false,

      totalPrice: 0,
      totalShip: 0,

      success_order: false,
      error_order: false,

      order: []
    }

    this.state = this.defState;
  }







  onAddRow(vals) {
    this.setState({ parseLink: true });
    parseSite(vals)
      .then(res => {
        this.parseLinkRes(JSON.parse(res));
      });
  }




  parseLinkRes(res) {
    if (parseInt(res.error)) {
      this.setState({ message: this.MESS.error_parse_link, parseLink: false });
    } else {
      this.addRow(res);
    }
  }



  addRow(res) {
    let newOrder = [...this.state.order, res];
    let total = this.calcTotal(newOrder);
    this.setState({
      order: newOrder,
      parseLink: false,
      totalPrice: total.totalPrice,
      totalShip: total.totalShip,
      message: null
    });
  }



  componentDidMount() {
    getCalcSettings()
      .then(res => {
        this.sets = res;
        this.MESS = res.MESS;
        this.setState({ load: false, instructions: this.MESS.instructions });
      });
  }





  onDeleteRow(i) {
    let order = [...this.state.order];
    order.splice(i, 1);
    let total = this.calcTotal(order);
    this.setState({
      order: order,
      totalPrice: total.totalPrice,
      totalShip: total.totalShip
    });
  }




  onRowQuantityChange({ quantity, total, index }) {
    let order = [...this.state.order];
    order[index].quantity = quantity;
    order[index].total = total;

    let calcTotal = this.calcTotal(order);

    this.setState({
      totalPrice: calcTotal.totalPrice,
      totalShip: calcTotal.totalShip
    });
  }





  calcTotal(order) {
    let totalPrice = 0;
    order.forEach(item => {
      totalPrice = totalPrice + parseFloat(item.total);
    });
    totalPrice = parseFloat(totalPrice).toFixed(2);
    let totalShip = this.calcShip(totalPrice);
    return { totalPrice: totalPrice, totalShip: totalShip };
  }




  calcShip(totalPrice) {
    totalPrice = parseFloat(totalPrice);
    let prices = this.sets.prices;
    let min = parseFloat(this.sets.min);
    let resIndex = [];

    prices.forEach((price, i) => {
      let start = price[0] ? price[0] : 0;
      let end = price[1] ? price[1] : totalPrice + 1;
      if (totalPrice >= start && totalPrice < end && totalPrice >= min) {
        resIndex.push(i);
      }
    });
    if (!resIndex.length) return false;

    this.percent = parseInt(prices[resIndex[0]][2]);
    this.pricePercent = parseFloat(parseFloat(this.percent * totalPrice / 100).toFixed(2));
    let res = parseFloat(totalPrice + this.pricePercent).toFixed(2);
    return res;
  }






  onOrederSubmit(values) {
    values.order = this.state.order;
    values.totalPrice = this.state.totalPrice;
    values.totalShip = this.state.totalShip;
    values.shipCost = this.pricePercent;

    sendOrder(values)
      .then(res => {
        let state = {};
        state.load = false;
        if (res.type === 'success') {
          state.success_order = true;
          state.error_order = false;
          this.doEvent();
        } else {
          state.success_order = false;
          state.error_order = true;
        }
        this.setState(Object.assign(this.state, state));
      });
    this.setState({ load: true });
  }




  doEvent() {
    let ev = new Event('success_order');
    document.body.dispatchEvent(ev);
  }





  resetState() {
    let state = {
      load: false,
      parseLink: false,
      message: null,
      orderForm: false,

      totalPrice: 0,
      totalShip: 0,

      success_order: false,
      error_order: false,

      order: []
    }

    this.setState(state);
  }


  render() {

    if (this.state.success_order && !this.state.error_order) {
      return (
        <div className="shipping-calculator finish-order success">
          <div className="success-order" dangerouslySetInnerHTML={{ __html: this.MESS.text_after_submit_order }}></div>
          <div className="btn-row">
            <button type="button" className="btn yellow-btn" onClick={() => this.resetState()}>Завершить</button>
          </div>
        </div>
      );
    }


    if (this.state.error_order && !this.state.success_order) {
      return (
        <div className="shipping-calculator finish-order error">
          <div className="error-order" dangerouslySetInnerHTML={{ __html: this.MESS.on_email_errorr }}></div>
          <div className="btn-row">
            <button type="button" className="btn yellow-btn" onClick={() => this.resetState()}>Завершить</button>
          </div>
        </div>
      );
    }


    if (this.state.load) {

      return (
        <Preloader />
      );

    } else {


      if (this.state.orderForm) {
        return (
          <div className="shipping-calculator">
            <OrderForm mess={this.MESS} underForm={this.MESS.text_under_order_form} onSubmit={values => this.onOrederSubmit(values)} onClose={() => this.setState({ orderForm: false })} />
          </div>
        );
      }


      return (
        <div className="shipping-calculator">
          <div className="wrap-calculator">
            <h3 className="title-block">{this.MESS.block_title}</h3>

            <AddCalcRow mess={this.MESS} onAdd={vals => this.onAddRow(vals)} />

            {this.state.message ? <div className="err-mess" dangerouslySetInnerHTML={{ __html: this.state.message }} ></div> : null}

            {this.state.order.length && !this.state.parseLink ? <ResultContainer
              orders={this.state.order}
              title={this.MESS.title_res}
              currency={this.sets.final_currency}
              onRowQuantityChange={(sets) => this.onRowQuantityChange(sets)}
              onDeleteRow={i => this.onDeleteRow(i)} /> : null}

            {this.state.parseLink ? <Preloader /> : null}

            {parseFloat(this.state.totalPrice) >= parseFloat(this.sets.min) ? <TotalShipContainer
              displayBtn={!this.state.orderForm}
              onOrder={() => this.setState({ orderForm: true })}
              ship={this.pricePercent}
              currency={this.sets.final_currency}
              totalShip={this.state.totalShip}
              totalPrice={this.state.totalPrice}
              titleTotalPrice={this.MESS.title_total_price}
              titleTotalShip={this.MESS.title_total_ship}
              titleShip={this.MESS.title_ship}
            /> : <div className="not-min-mess">{this.MESS.not_min}: <strong>{this.sets.min} {this.sets.final_currency}</strong></div>}

            <Instructions instructions={this.state.instructions} title={this.MESS.title_instructions} />
            <Logo src={this.sets.SRC} />
          </div>
        </div>
      );

    }

  }



}






const Logo = ({ src }) => {
  return (
    <div className="logo-wrap">
      <a href="/" className="logo-link">
        <img src={src + 'img/logo.png'} alt="logo" />
      </a>
    </div>
  );
}






const ResultContainer = ({ orders, title, currency, onRowQuantityChange, onDeleteRow }) => {
  return (
    <div className="result-container">
      <h4 className="title-result">{title}:</h4>
      <div className="res-table">
        <CalcRowHead currency={currency} />
        {orders.map((order, i) =>
          <CalcRow
            onQuantityChange={sets => onRowQuantityChange(sets)}
            link={order.link}
            key={i}
            count={i}
            name={order.name}
            price={order.cost}
            image={order.image}
            quantity={order.quantity}
            total={order.total}
            onDelete={() => onDeleteRow(i)}
          />
        )}
      </div>
    </div>
  );
}









const TotalShipContainer = ({ totalShip, totalPrice, currency, ship, onOrder, displayBtn, titleTotalPrice, titleTotalShip, titleShip }) => {
  return (
    <div className="total-res-container">
      <div className="total-res-row">
        <div className="title">{titleTotalPrice}:</div>
        <div className="val">{totalPrice} {currency}</div>
      </div>
      <div className="total-res-row">
        <div className="title">{titleTotalShip}:</div>
        <div className="val">{totalShip} {currency}</div>
      </div>
      <div className="total-res-row">
        <div className="title">{titleShip}:</div>
        <div className="val">{ship} {currency}</div>
      </div>
      {displayBtn ? (
        <div className="total-res-row btn-row">
          <button type="button" className="btn yellow-btn" onClick={() => onOrder && onOrder()}>Оформить заказ</button>
        </div>
      ) : null}
    </div>
  );
}












const Instructions = ({ instructions, title }) => {
  return (
    <div className="instructions">
      <h4 className="title-result">{title}</h4>
      <div className="content " dangerouslySetInnerHTML={{ __html: instructions }}></div>
    </div>
  );
}
