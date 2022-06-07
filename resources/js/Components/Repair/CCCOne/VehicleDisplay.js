import React from 'react';


export default function VehicleDisplay({ year, make, model, style, color, sizing }){

  return (
    <div className="w-full" style={{marginBottom: sizing.vehicleDisplay.mb}}>{year} {make} {model} {style} {color}</div>
  )
}
