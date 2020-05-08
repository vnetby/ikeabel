import React from 'react';
import IMask from 'imask';


export class OrderForm extends React.Component {


  constructor( props ) {

    super ( props );

    this.phoneValue = '';

    this.phoneColRef  = React.createRef();
    this.nextInputRef = React.createRef();

    this.MESS = props.mess;

    this.state = {
      name   : '',
      phone  : '',
      email  : '',
      address: '',

      nameError   : false,
      phoneError  : false,
      emailError  : false,
      addressError: false
    };
  }




  setPhone (e) {
    let val = e.target.value;
    this.setState({phone: val});
  }




  onFormSubmit () {
    let errors = {nameError: false, phoneError: false, emailError: false, addressError: false};

    if ( !this.state.name ) {
      errors.nameError = this.MESS.required_field;
    }

    if ( !this.state.phone ) {
      errors.phoneError = this.MESS.required_field;
    }

    if ( !this.state.email ) {
      errors.emailError = this.MESS.required_field;
    }

    if ( !this.state.address ) {
      errors.addressError = this.MESS.required_field;
    }


    if ( !errors.phoneError && !this.validatePhone() ) {
      errors.phoneError = this.MESS.not_valid_phone;
    }

    if ( !errors.emailError && !this.validateEmail() ) {
      errors.emailError = this.MESS.not_valid_email;
    }


    if ( Object.values( errors ).some( item => item ) ) {
      this.setState(Object.assign(this.state, errors));
      return;
    }
    this.props.onSubmit && this.props.onSubmit(this.state);

  }





  validatePhone () {
    let re = /^\+375[0-9]{9,9}$/;
    return re.test(this.state.phone);
  }



  validateEmail () {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(this.state.email).toLowerCase());
  }




  componentDidMount() {
    this.phoneCol   = this.phoneColRef.current;
    this.phoneInput = this.phoneCol.querySelector('.calc-input');
    this.phoneInput.addEventListener('keyup', this.onKeyUp.bind(this) );
    this.mask = IMask( this.phoneInput, {
      mask: '+{375} (00) 000 - 00 - 00'
    });
  }



  componentWillUnmount () {
    this.mask.destroy();
    this.phoneInput.removeEventListener('keyup', this.onKeyUp.bind(this) );
  }


  onKeyUp () {
    this.setState({phoneError: false, phone: '+' + this.mask.unmaskedValue, maskPhone: this.mask.value});
  }



  backSpaceMask (i) {
    let item = this.maskItems[i];
    let val  = item.value;
    if ( !val && !this.maskItems[i-1] ) {
      return;
    }
    if ( !val ) {
      this.maskItems[i-1].focus();
      return;
    }
    let num;

    while ( this.maskItems[i] && this.maskItems[i].value  ) {
      item = this.maskItems[i];
      val  = item.value;
      num  = parseInt(item.dataset.num);
      i    = i+1;
    }

    item.value = item.value.substring(0, item.value.length - 1);
    item.focus();

  }





  onInputChange ( e ) {
    let name      = e.target.name;
    let nameError = `${name}Error`;
    this.setState({[name] : e.target.value, [nameError] : false });
  }




  render() {

    return (
      <div className="order-form">

        <div className="form-wrap">

          <button className="close-btn" onClick={() => this.props.onClose && this.props.onClose()}></button>

          <div className="form-title">{this.MESS.order_form_title}</div>

          <div className="form-row">
            <InputCol
              name        ="name"
              error       ={this.state.nameError}
              placeholder ={this.MESS.name_placeholder}
              value       ={this.state.name}
              helpError   ={this.state.nameError}
              onChange    ={e => this.onInputChange(e)}
              />
          </div>

          <div className="form-row">
            <InputCol
              isPhone     ={true}
              ref         ={this.phoneColRef}
              name        ="phone"
              error       ={this.state.phoneError}
              placeholder ={this.MESS.phone_placeholder}
              helpError   ={this.state.phoneError}
              />
            <InputCol
              ref         ={this.nextInputRef}
              name        ="email"
              error       ={this.state.emailError}
              placeholder ={this.MESS.email_placeholder}
              value       ={this.state.email}
              helpError   ={this.state.emailError}
              onChange    ={e => this.onInputChange(e)}
              />
          </div>


          <div className="form-row">
            <InputCol
              name        ="address"
              error       ={this.state.addressError}
              placeholder ={this.MESS.address_placeholder}
              value       ={this.state.address}
              helpError   ={this.state.addressError}
              onChange    ={e => this.onInputChange(e)}
              />
          </div>


          <div className="btn-row right">
            <button type="button" className="btn yellow-btn" onClick={() => this.onFormSubmit()}>Отправить</button>
          </div>


          {this.props.underForm ? <div className="under-form-text" dangerouslySetInnerHTML={{__html:this.props.underForm}} /> : null}


        </div>

      </div>
    );

  }


}









const InputCol = React.forwardRef(({name, error, placeholder, onChange, value, helpError, isPhone}, ref) => {
  return (
    <div ref={ref} className={isPhone ? "form-col phone-col" : "form-col" }>
      <div className="input-row">
        <div className="input-wrap">
          {
            isPhone ?
            <input placeholder="+375 (__) - ___ - __ - __" type="text" name={name} className={`calc-input ${error ? 'has-error' : ''}`} /> :
              <input type="text" name={name} className={`calc-input ${error ? 'has-error' : ''}`} value={value ? value : ''} onChange={e => onChange && onChange( e )} />
            }
            <span className={`placeholder ${value || isPhone ? 'active' : ''}`}>{placeholder}</span>
            <span className={`underline ${value || isPhone ? 'active' : ''}`}></span>
          </div>
          <div className={`input-help ${helpError ? 'error' : ''}`}>{helpError}</div>
        </div>
      </div>

    );
  } );

  // {isPhone ? <div className={`calc-input phone-input ${error ? 'has-error' : ''}`} /> : <input type="text" name={name} className={`calc-input ${error ? 'has-error' : ''}`} value={value ? value : ''} onChange={e => onChange && onChange( e )} />}





  const PhoneMask = () => {
    return (
      <div className="phone-mask">
        <span className="before-phone">+375</span>
        ( <input type="text" className="code num-2 editable" data-num="2"></input> )
        <span className="divider"></span>
        <input type="text" className="first num-3 editable" data-num="3"></input>
        <span className="divider"></span>
        <input type="text" className="second num-2 editable" data-num="2"></input>
        <span className="divider"></span>
        <input type="text" className="third num-2 editable" data-num="2"></input>
      </div>
    );
  }







  const setCaretPosition = (elem, caretPos) => {
    if(elem != null) {
      if(elem.createTextRange) {
        var range = elem.createTextRange();
        range.move('character', caretPos);
        range.select();
      }
      else {
        if(elem.selectionStart) {
          elem.setSelectionRange(caretPos, caretPos);
        }
      }
    }
  }
