import React from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';

export default function PageTop({ first, last, ro, docVerCode, docVerNum, docStatus, sizing }){


  return (
    <div>
    <div className="font-bold text-center border-solid border-gray-900 w-full" style={{fontSize: sizing.pageTop.t, paddingBottom: sizing.pageTop.pb, marginBottom: sizing.pageTop.mbl, borderBottomWidth: sizing.pageTop.bb}}>{Rend.estimate_ver(docVerCode, docVerNum, docStatus)}</div>
      <div className="flex justify-between" style={{marginBottom: sizing.pageTop.mbs}}>
        <div className="font-bold" style={{fontSize: sizing.pageTop.t}}>Customer: {last}, {first}</div>
        <div className="font-bold" style={{fontSize: sizing.pageTop.t}}>Job Number: {ro}</div>
      </div>
    </div>
  )
}
