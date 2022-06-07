import React from 'react';


export default function LineHeader({ sizing }){
  return (
    <div className="flex border-solid border-gray-900 w-full" style={{borderBottomWidth: sizing.lineHeader.bb, borderTopWidth: sizing.lineHeader.bt, marginTop: sizing.lineHeader.mt}}>
        <div className="w-[6%] text-center font-bold" style={{fontSize: sizing.lineHeader.tl}}>Line</div>
        <div className="w-[4%]" style={{padding: sizing.lineHeader.p}}></div>
        <div className="w-[6%]" style={{padding: sizing.lineHeader.p}}></div>
        <div className="w-[6%] text-right font-bold" style={{fontSize: sizing.lineHeader.tl}}>Oper</div>
        <div className="w-[26%] text-center font-bold" style={{fontSize: sizing.lineHeader.tl}}>Description</div>
        <div className="w-[14%] text-center font-bold" style={{fontSize: sizing.lineHeader.tl}}>Part Number</div>
        <div className="w-[4%] text-right font-bold" style={{fontSize: sizing.lineHeader.tl}}>Qty</div>
        <div className="w-[10%] text-right font-bold" style={{fontSize: sizing.lineHeader.tl}}>Extended Price $</div>
        <div className="w-[3%]" style={{padding: sizing.lineHeader.p}}></div>
        <div className="w-[3%]" style={{padding: sizing.lineHeader.p}}></div>
        <div className="w-[6%] text-right font-bold" style={{fontSize: sizing.lineHeader.tl}}>Labor</div>
        <div className="w-[6%]" style={{padding: sizing.lineHeader.p}}></div>
        <div className="w-[6%] text-right font-bold" style={{fontSize: sizing.lineHeader.tl}}>Paint</div>
    </div>
  )
}
