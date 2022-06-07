import React from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';
import TotalsHeader from '@/Components/Repair/CCCOne/TotalsHeader';

export default function Totals({ totals, sizing }){


  return (
    <div className="flex">
      <div className="w-[28%]"></div>
        <div className="w-full">
          <TotalsHeader sizing={sizing}/>
          <div className="border-solid border-gray-900" style={{borderBottomWidth: sizing.totals.bb, marginBottom: sizing.totals.mbs}}>
            {totals && Rend.parts_subtotals(totals.subtotals, totals.part_rates, sizing)}
            {totals && Rend.parts_discounts(totals.subtotals, totals.part_rates, sizing)}
            {totals && Rend.hourly_labor(totals.subtotals, totals.labor_rates, sizing)}
            {totals && Rend.hourly_mat(totals.subtotals, totals.material_rates, sizing)}
            {totals && Rend.misc(totals.subtotals, sizing)}
          </div>
          <div className="border-solid border-gray-900 flex" style={{borderBottomWidth: sizing.totals.bb, marginBottom: sizing.totals.mbs, paddingBottom: sizing.totals.pbs}}>
            <div className="w-[50%]">Subtotal</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right">{totals && totals.totals['T2'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
          {totals && Rend.tax(totals.totals, totals.tax_rate, sizing)}
          <div className="border-solid border-gray-900 flex" style={{borderBottomWidth: sizing.totals.bb, marginBottom: sizing.totals.mbs, paddingBottom: sizing.totals.pbs}}>
            <div className="w-[50%] font-bold">Grand Total</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right font-bold" style={{fontSize: sizing.totals.t}}>{totals && totals.totals['TT'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
          {totals && Rend.cust_subtotals(totals.totals, sizing)}
          <div className="border-solid border-gray-900 flex" style={{borderBottomWidth: sizing.totals.bb, marginBottom: sizing.totals.mbs, paddingBottom: sizing.totals.pbs}}>
            <div className="w-[50%] font-bold" style={{fontSize: sizing.totals.t}}>CUSTOMER PAY</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right font-bold" style={{fontSize: sizing.totals.t}}>{totals && totals.totals['CUST'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
          <div className="border-solid border-gray-900 flex" style={{borderBottomWidth: sizing.totals.bb, marginBottom: sizing.totals.mbs, paddingBottom: sizing.totals.pbs}}>
            <div className="w-[50%] font-bold" style={{fontSize: sizing.totals.t}}>INSURANCE PAY</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right font-bold" style={{fontSize: sizing.totals.t}}>{totals && totals.totals['INS'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
        </div>
      </div>
  )
}
