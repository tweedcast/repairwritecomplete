import React from 'react';
import VehicleDisplay from '@/Components/Repair/CCCOne/VehicleDisplay';

export default function VehicleInfo({ vin, year, make, model, style, color, prodDate, mileage, ro, sizing }){


  return (
    <div>
      <div className="font-bold text-center w-full" style={{fontSize: sizing.vehicleInfo.tl, marginBottom: sizing.vehicleInfo.mbl}}>VEHICLE</div>
      <VehicleDisplay year={year} make={make} model={model} style={style} color={color} sizing={sizing}/>
      <div className="flex border-solid border-gray-900" style={{marginBottom: sizing.vehicleInfo.mbl, paddingBottom: sizing.vehicleInfo.pbl, borderBottomWidth: sizing.vehicleInfo.bb}}>
        <div className="flex flex-col w-1/4">
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>VIN: <span className="grow text-center">{vin}</span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>License: <span className="grow text-center"></span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>State: <span className="grow text-center"></span></div>
        </div>
        <div className="flex flex-col w-1/4">
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Interior Color: <span className="grow text-center"></span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Exterior: <span className="grow text-center">{color}</span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Production Date: <span className="grow text-center">{prodDate}</span></div>
        </div>
        <div className="flex flex-col w-1/4">
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Mileage In: <span className="grow text-center">{mileage}</span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Mileage Out: <span className="grow text-center"></span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Condition: <span className="grow text-center"></span></div>
        </div>
        <div className="flex flex-col w-1/4">
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Vehicle Out: <span className="grow text-center"></span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}><span className="grow text-center"></span></div>
          <div className="flex" style={{marginBottom: sizing.vehicleInfo.mbs}}>Job #: <span className="grow text-center">{ro}</span></div>
        </div>
      </div>
    </div>
  )
}
