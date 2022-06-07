import React from 'react';

export default function NewSuggestion({ desc, handleChange, handleEnter, handleBlur, sizing, adding }){

  return (
    <div className="w-full relative flex">
        <input
          type="text"
          value={desc}
          onChange={handleChange}
          onKeyUp={handleEnter}
          onBlur={handleBlur}
          className="appearance-none decoration-none outline-none p-0 w-full border-solid border-sky-300 focus:border-sky-300"
          style={{height: sizing.newSuggestion.h, paddingLeft: sizing.newSuggestion.pl, fontSize: sizing.newSuggestion.t, borderWidth: sizing.newSuggestion.b}}
          >
        </input>      
      {adding && <div className="absolute w-full h-full top-0 left-0" style={{backgroundColor: '#7dd3fc85'}}></div>}
    </div>
  )
}
