import React from 'react';
import { Circles } from 'react-loader-spinner';

export default function VehicleOptions({ options, sizing }){


  return (
    <div className="flex" style={{padding: sizing.vehicleOptions.p}}>
      {options ?
      options.map((opt, index)=>{
        return <div className="w-1/3" key={index}>{opt.map((o, index)=>{return o[0] === 'G' ? <div key={index} className="font-bold" style={{marginBottom: sizing.vehicleOptions.mbs}}>{o[1]}</div> : <div key={index} style={{marginBottom: sizing.vehicleOptions.mbs}}>{o[1]}</div>})}</div>
      }) :
      <Circles height={100} width={100} />}
    </div>
  )
}
