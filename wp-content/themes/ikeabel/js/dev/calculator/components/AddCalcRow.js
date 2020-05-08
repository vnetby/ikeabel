import React from 'react';


export class AddCalcRow extends React.Component {

  constructor ( props ) {
    super ( props );

    let expression = /[-a-zA-Z0-9@:%._\+~# =]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&// =]*)?/gi;
    this.regexUrl  = new RegExp(expression);

    this.MESS = props.mess;

    this.state = {
      link       : '',
      number     : 1,

      linkError  : false,
      numberError: false
    }
  }





  validateInputs () {
    let validate = [];

    validate.push( this.validateLink() );
    validate.push( this.validateNumber() );

    let check = !validate.some( item => !item );

    if ( check ) {
      this.setState({link: '', number: 1});
    }

    return check;
  }



  validateLink () {
    if ( !this.state.link.match(this.regexUrl) ) {
      this.setState({ linkError: this.MESS.not_valid_url });
      return false;
    } else {
      this.setState({ linkError: false });
      return true;
    }
  }




  validateNumber () {
    if ( !parseInt( this.state.number) ) {
      this.setState({numberError: this.MESS.not_valid_number});
      return false;
    }
    if ( parseInt( this.state.number ) < 1 ) {
      this.setState({numberError: this.MESS.less_one});
      return false;
    }
    this.setState({numberError: false});
    return true;
  }




  onLinkChange ( e ) {
    this.setState({
      link: e.target.value,
      linkError: false
    });
  }




  onNumberChange ( e ) {
    this.setState({
      number     : e.target.value,
      numberError: false
    });
  }





  render () {
    return (
      <div className="calc-row control-row">

        <div className="calc-col link-col">
          <div className="input-row">
            <div className="input-wrap">
              <input type="text" name="linkProduct" className={`calc-input link-input ${this.state.linkError ? 'has-error' : ''}`} value={this.state.link} onChange={e => this.onLinkChange(e)}/>
              <span className={`placeholder ${this.state.link ? 'active' : ''}`}>{this.MESS.link_placeholder}</span>
              <span className={`underline ${this.state.link ? 'active' : ''}`}></span>
            </div>
            <div className={`input-help ${this.state.linkError ? 'error' : ''}`}>{this.state.linkError ? this.state.linkError : ''}</div>
          </div>
        </div>

        <div className="calc-col quantity-col">
          <div className="input-row number-input-row">
            <button className="minus-control num-control control-btn" onClick={ e => parseInt(this.state.number) - 1 > 0 && this.setState({number: parseInt(this.state.number) - 1})}></button>
            <div className="input-wrap">
              <input type="number" min="1" name="quantityProduct" className={`calc-input quantity-input ${this.state.numberError ? 'has-error' : ''}`} value={this.state.number} onChange={e => this.onNumberChange( e )}/>
              <span className={`placeholder ${this.state.number ? 'active' : ''}`}>{this.MESS.num_placeholder}</span>
              <span className={`underline ${this.state.number ? 'active' : ''}`}></span>
            </div>
            <button className="plus-control num-control control-btn" onClick={ () => this.setState({number: parseInt(this.state.number) + 1})}></button>
            <div className={`input-help ${this.state.numberError ? 'error' : ''}`}>{this.state.numberError ? this.state.numberError : ''}</div>
          </div>
        </div>

        <div className="calc-col control-col">
          <button className="control-btn action-btn add-row" onClick={() => this.validateInputs() && this.props.onAdd && this.props.onAdd({link: this.state.link, number: this.state.number})}>Добавить</button>
        </div>

      </div>
    );
  }
}
