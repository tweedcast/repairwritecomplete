import React from 'react';


export default function TotalsHeader({ sizing }){


  return (
    <div>
      <div className="font-bold" style={{fontSize: sizing.totalsHeader.t}}>ESTIMATE TOTALS</div>
      <div className="w-full border-solid border-gray-900 flex" style={{marginBottom: sizing.totalsHeader.mb, borderBottomWidth: sizing.totalsHeader.bb, borderTopWidth: sizing.totalsHeader.bt}}>
        <div className="w-[50%] font-bold">Category</div>
        <div className="w-[14%] font-bold text-right">Basis</div>
        <div className="w-[8%] font-bold text-center"></div>
        <div className="w-[14%] font-bold text-right">Rate</div>
        <div className="w-[14%] font-bold text-right">Cost $</div>
      </div>
    </div>
  )
}
