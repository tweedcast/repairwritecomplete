import React, { useState, useEffect } from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';

export default function SummaryModal({ summary }){

   const renderLineSummary = () => {
     return Object.keys(summary).map((sec)=>{
       return (
         <div>
           <h2>{sec}</h2>
           {Object.keys(summary[sec]).map((sub)=>{
             return (
               <div>
                 <h3>Line {sub}</h3>
                 {summary[sec][sub].map((item)=>{
                   return <p>{item}</p>
                 })}
               </div>
             )
             })}
         </div>
       )
     })
   }

  return (
    <div className="fixed h-full w-full flex justify-center items-center top-0 left-0" style={{backgroundColor: 'rgba(0, 0, 0, 0.7)'}}>
      <div className="w-[80%] h-[80%] bg-white flex p-6">
        <div className="flex flex-col p-6 shadow-xl">
          <h2 className="bg-slate-500 text-white font-bold px-4 mb-2">Line Changes/Suggestions</h2>
          <div>
            {renderLineSummary()}
          </div>
        </div>
      </div>
    </div>
  )
}
