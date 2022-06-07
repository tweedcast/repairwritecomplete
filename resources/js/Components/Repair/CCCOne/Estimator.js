import React from 'react';


export default function Estimator({ first, last, sizing }){


  return (
    <div className="flex justify-center" style={{marginBottom: sizing.estimator.mb}}>
      <div>Written by: {first} {last}</div>
    </div>
  )
}
