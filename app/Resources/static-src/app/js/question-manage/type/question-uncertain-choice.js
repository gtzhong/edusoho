import QuestionChoice from './question-choice';
import ReactDOM from 'react-dom';
import React from 'react';
import QuestionOptions from '../../../common/component/question-options';

class SingleChoice extends QuestionChoice {
  initOptions() {
    let dataSource = $('#question-options').data('choices');
    let dataAnswer = $('#question-options').data('answer');
    if(dataSource) {
      dataSource = JSON.parse(dataSource);
      dataAnswer = JSON.parse(dataAnswer);
    }else {
      dataSource= [];
    }

    console.log(dataSource);
    console.log(dataAnswer);
    ReactDOM.render( <QuestionOptions dataSource={dataSource} dataAnswer={dataAnswer} />,
      document.getElementById('question-options')
    );
  }
}

export default SingleChoice;