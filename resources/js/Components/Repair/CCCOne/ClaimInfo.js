import React from 'react';


export default function ClaimInfo({ first, last, claimNo, sizing }){


  return (
    <div className="flex" style={{marginBottom: sizing.claimInfo.mbl}}>
      <div className="w-1/3">
        <div className="flex" style={{marginBottom: sizing.claimInfo.mbs}}>Insured: <span className="text-center grow">{last}, {first}</span></div>
        <div style={{marginBottom: sizing.claimInfo.mbs}}>Type of Loss:</div>
        <div style={{marginBottom: sizing.claimInfo.mbs}}>Point of Impact:</div>
      </div>
      <div className="w-1/3">
        <div style={{marginBottom: sizing.claimInfo.mbs}}>Policy #:</div>
        <div style={{marginBottom: sizing.claimInfo.mbs}}>Date of Loss:</div>
      </div>
      <div className="w-1/3">
        <div className="flex" style={{marginBottom: sizing.claimInfo.mbs}}>Claim #: <span className="text-center grow">{claimNo}</span></div>
        <div style={{marginBottom: sizing.claimInfo.mbs}}>Days to Repair:</div>
      </div>
    </div>
  )
}
