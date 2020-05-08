import React from 'react';


export const CalcRowHead = props => {
  return (
    <div className="calc-row head-row">
      <div className="calc-col count-col">#</div>
      <div className="calc-col image-col">Изображение</div>
      <div className="calc-col name-col">Наименование</div>
      <div className="calc-col quantity-col">Количество</div>
      <div className="calc-col price-col">Стоимость<br />{props.currency}</div>
      <div className="calc-col total-col">Итог<br />{props.currency}</div>
      <div className="calc-col control-col">#</div>
    </div>
  );
}
