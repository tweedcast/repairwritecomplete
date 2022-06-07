import React from 'react';
import Codes from '@/OperationCodes/Codes';

export default function LineFooter({ totals, sizing }){
  return (
    <div className="w-full border-solid border-gray-900 flex" style={{marginBottom: sizing.lineFooter.mb, borderBottomWidth: sizing.lineFooter.bb, borderTopWidth: sizing.lineFooter.bt}}>
      <div className="w-[48%]"></div>
      <div className="w-[14%] text-center font-bold" style={{padding: sizing.lineFooter.p}}>SUBTOTALS</div>
      <div className="w-[4%] text-right font-bold" style={{padding: sizing.lineFooter.p}}></div>
      <div className="w-[10%] text-right font-bold" style={{padding: sizing.lineFooter.p}}>{totals && Codes.aggregate(totals.subtotals, totals.part_rates).parts.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
      <div className="w-[3%]" style={{padding: sizing.lineFooter.p}}></div>
      <div className="w-[3%]" style={{padding: sizing.lineFooter.p}}></div>
      <div className="w-[6%] text-right font-bold" style={{padding: sizing.lineFooter.p}}>{totals && Codes.aggregate(totals.subtotals, totals.part_rates).labor}</div>
      <div className="w-[6%]" style={{padding: sizing.lineFooter.p}}></div>
      <div className="w-[6%] text-right font-bold" style={{padding: sizing.lineFooter.p}}>{totals && Codes.aggregate(totals.subtotals, totals.part_rates).paint}</div>
    </div>
  )
}
