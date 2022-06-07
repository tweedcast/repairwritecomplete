import React, { useState, useEffect } from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';
import SummaryModal from '@/Components/Repair/CCCOne/SummaryModal';

export default function Summary({ lines }){
  const [summary, setSummary] = useState(null);



  const buildSummary = (lines) => {
    var header = 'PRE REPAIR';
    var summary = {};
    lines.map((line, index)=>{
      var sub_header = '';
      if(line.is_header){
        header = line.line_desc
      }
      if(Object.keys(line.modifications).length > 0 ) {
        if(!(header in summary)){
          summary[header] = {}
        }
        sub_header = line.line_num;
        var sub_mods = Rend.summary_mods(line, line.modifications);

        summary[header][sub_header] = sub_mods;
      }
    })
    setSummary(summary)
  }



  const handleClick = () => {
    lines && buildSummary(lines)
  }

  return (
    <div className="sm:w-full md:w-auto px-2 py-1 bg-slate-500 flex justify-center items-center">
      <button className="bg-white px-2 font-bold" onClick={()=>{handleClick()}}>Summary</button>
      {summary && <SummaryModal summary={summary} />}
    </div>
  )
}
