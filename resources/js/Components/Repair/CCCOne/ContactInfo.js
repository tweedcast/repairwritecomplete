import React from 'react';


export default function ContactInfo({ first, last, phone, rfName, rfAddress1, rfAddress2, rfCity, rfState, rfZip, rfPhone, insName, sizing }){


  return (
    <div className="flex border-solid border-gray-900" style={{marginBottom: sizing.contactInfo.mbl, paddingBottom: sizing.contactInfo.pb, borderBottomWidth: sizing.contactInfo.bb}}>
      <div className="w-1/3">
        <div className="font-bold" style={{marginBottom: sizing.contactInfo.mbs}}>Owner:</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{last}, {first}</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{phone} Cell</div>
      </div>
      <div className="w-1/3">
        <div className="font-bold" style={{marginBottom: sizing.contactInfo.mbs}}>Inspection Location:</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{rfName.toUpperCase()}</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{rfAddress1.toUpperCase()} {rfAddress2.toUpperCase()}</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{rfCity.toUpperCase()}, {rfState.toUpperCase()} {rfZip}</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{rfPhone} Business</div>
      </div>
      <div className="w-1/3">
        <div className="font-bold" style={{marginBottom: sizing.contactInfo.mbs}}>Insurance Company:</div>
        <div style={{marginBottom: sizing.contactInfo.mbs}}>{insName}</div>
      </div>
    </div>
  )
}
