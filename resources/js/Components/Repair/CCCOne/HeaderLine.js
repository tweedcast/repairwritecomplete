import React from 'react';


export default function HeaderLine({ id, lineNo, lineDesc, sizing }){


  return (
    <div id={'line_' + id} className="flex w-full border-solid border-neutral-200" style={{borderTopWidth: sizing.headerLine.bt}}>
      <div className="w-[6%] text-center" style={{padding: sizing.headerLine.p}}>{lineNo}</div>
      <div className="w-[34%] font-bold" style={{padding: sizing.headerLine.p, fontSize: sizing.headerLine.tl}}>{lineDesc}</div>
    </div>
  )
}
