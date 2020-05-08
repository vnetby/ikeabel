import React from 'react';






export class CalcRow extends React.Component {

  constructor (props) {
    super ( props );

    this.state = {
      quantity     : parseInt(props.quantity),
      quantityError: false,
      price        : parseFloat(props.price),
      total        : parseFloat(props.total)
    }
  }




  onAddTotal() {
    let quantity = this.state.quantity + 1;
    let total = (Math.round(this.state.price * quantity * 100) / 100).toFixed(2);
    this.props.onQuantityChange && this.props.onQuantityChange( {quantity: quantity, total, index: this.props.count} );
    this.setState({quantity: quantity, total: total});
  }



  onRemoveTotal() {
    let quantity = this.state.quantity - 1 > 0 ? this.state.quantity - 1 : this.state.quantity;
    let total = (Math.round(this.state.price * quantity * 100) / 100).toFixed(2);
    this.props.onQuantityChange && this.props.onQuantityChange( {quantity: quantity, total, index: this.props.count} );
    this.setState({quantity: quantity, total: total});
  }



  onNumberChange ( e ) {
    if ( parseInt ( e.target.value ) < this.state.quantity ) {
      this.onRemoveTotal();
    }
    if ( parseInt ( e.target.value ) > this.state.quantity ) {
      this.onAddTotal();
    }
  }




  render () {

    return (
      <div className="calc-row">
        <div className="calc-col count-col">{this.props.count + 1 || ''}</div>
        <div className="calc-col image-col"><img src={this.props.image} /></div>
        <div className="calc-col name-col"><a href={this.props.link} target="_blank">{this.props.name || ''}</a></div>

        <div className="calc-col quantity-col">
          <div className="input-row number-input-row">
            <button className="minus-control num-control control-btn" onClick={ e => this.onRemoveTotal() }></button>
            <div className="input-wrap">
              <input type="number" min="1" name="quantityProduct" className={`calc-input quantity-input ${this.state.quantityError ? 'has-error' : ''}`} value={this.state.quantity} onChange={e => this.onNumberChange( e )}/>
              <span className={`underline ${this.state.quantity ? 'active' : ''}`}></span>
            </div>
            <button className="plus-control num-control control-btn" onClick={ e => this.onAddTotal() }></button>
            <div className={`input-help ${this.state.quantityError ? 'error' : ''}`}>{this.state.quantityError ? this.state.quantityError : ''}</div>
          </div>
        </div>

        <div className="calc-col price-col">{this.state.price}</div>
        <div className="calc-col total-col">{this.state.total}</div>
        <div className="calc-col control-col"><button type="button" className="control-btn action-btn delete-row" onClick={() => this.props.onDelete && this.props.onDelete()}>Удалить</button></div>
      </div>
    );

  }



}
