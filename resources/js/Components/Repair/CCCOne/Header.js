import React from 'react';


export default function Header({ rfName, rfAddress1, rfAddress2, rfCity, rfState, rfZip, rfPhone, sizing }){


  return (
    <div className="text-center flex flex-col items-center">
      <div className="w-1/3" style={{marginBottom: sizing.header.mb}}>
        <div className="font-bold" style={{fontSize: sizing.header.tb}}>{rfName.toUpperCase()}</div>
        <div className="flex justify-center" style={{fontSize: sizing.header.t}}>{rfAddress1.toUpperCase()} {rfAddress2.toUpperCase()}</div>
        <div className="flex justify-center" style={{fontSize: sizing.header.t}}>{rfCity.toUpperCase()}, {rfState.toUpperCase()} {rfZip}</div>
        <div style={{fontSize: sizing.header.t}}>Phone: {rfPhone}</div>
      </div>
    </div>
  )
}
