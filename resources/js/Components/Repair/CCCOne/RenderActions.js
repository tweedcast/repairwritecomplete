import Codes from '@/OperationCodes/Codes';

export default class RenderActions {

  static estimate_ver = (document_ver_code, document_ver_num, document_status) => {
    if(document_ver_code == 'EM' && document_status == 'I'){
      return 'Preliminary Estimate';
    }
    if(document_ver_code == 'EM' && document_status == 'C'){
      return 'Estimate of Record';
    }
    if(document_ver_code == 'SV' && document_status == 'I'){
      return 'Preliminary Supplement ' + document_ver_num + ' with Summary'
    }
    if(document_ver_code == 'SV' && document_status == 'C'){
      return 'Supplement of Record ' + document_ver_num + ' with Summary'
    }
  }


  static part_price = (part) => {
    var display = '';
    var price;
    if(part.price_judgement_ind){
      display = "underline";
    }
    if(part.price_incl_ind){
      price = "Incl.";
    } else {
      price = parseFloat(part.part_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
    return <span className={display}>{price}</span>;
  }


  static labor = (labor) => {
    var display = '';
    var labor;
    if(labor.labor_hours_judgement_ind){
      display = 'underline';
    }
    if(labor.labor_incl_ind){
      labor = 'Incl.';
    } else {
      labor = labor.labor_hours
    }
    return <span className={display}>{labor}</span>;
  }


  static line_ind = (manual, part, labor, refinish) => {
    if(manual){
      return '#';
    }
    if((part && part.line_desc_modifier == 'A/M') || (part && part.line_desc_modifier == 'Opt OEM') || (part && part.line_desc_modifier == 'RECOND')){
      return '**'
    }
    if((part && part.price_judgement_ind) || (labor && (labor.labor_hours_judgement_ind || labor.labor_type_judgement_ind)) || (refinish && (refinish.labor_hours_judgement_ind || refinish.labor_type_judgement_ind))){
      return '*'
    }
  }


  static supp_ind = (doc_ver_code, doc_ver_num, line_ver_code) => {
    if(doc_ver_code == 'SV'){
      if(line_ver_code == 'SV'){
        return 'S' + doc_ver_num;
      }
    }
    return '';
  }


  static line_oper = (is_sublet, manual, labor, part, refinish) => {
    if(is_sublet){
      return 'Subl';
    }
    if(labor){
      return labor.labor_oper_display;
    }
    if(part && !manual){
      return 'Repl';
    }
    if(refinish){
      return refinish.labor_oper_display;
    }
    return '';
  }


  static database_labor_type = (labor) => {
    if(labor.database_labor_type == 'LAM'){
      return 'm';
    }
    if(labor.database_labor_type == 'LAS'){
      return 's';
    }
    return '';
  }


  static parts_subtotals = (subtotals, part_rates, sizing) => {
    var part_total = Codes.agg_repl_parts(subtotals, part_rates);
    if(part_total.parts > 0){
      return (
        <div className="flex w-full" style={{marginBottom: sizing.totals.mb}}>
          <div className="w-[50%]">Parts</div>
          <div className="w-[36%] font-bold text-right"></div>
          <div className="w-[14%] text-right">{part_total.parts.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
        </div>
      )
    }
  }


  static parts_discounts = (subtotals, part_rates, sizing) => {
    var discounts = Object.keys(part_rates).map((key, index)=>{
      if(key in subtotals){
        var rate = part_rates[key][0].adj_pct;
        var total = subtotals[key][0].t_amt / ((100 - rate) / 100);
        return (
          <div className="w-full flex" key={index} style={{marginBottom: sizing.totals.mb}}>
            <div className="w-[50%]">Parts Discount</div>
            <div className="w-[14%] text-right">$ {total.toFixed(2)}</div>
            <div className="w-[8%] text-center"></div>
            <div className="w-[14%] text-right">-{rate.toFixed(1)} %</div>
            <div className="w-[14%] text-right">{(subtotals[key][0].t_amt - total).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
        )
      }
    })
    return discounts;
  }


  static hourly_labor = (subtotals, labor_rates, sizing) => {
    var hour = Codes.get_labor_order().map((order, index)=>{
      if(order in subtotals){
        return (
          <div className="w-full flex" key={index} style={{marginBottom: sizing.totals.mb}}>
            <div className="w-[50%]">{Codes.get_label(order)}</div>
            <div className="w-[14%] text-right">{subtotals[order][0].t_hrs.toFixed(1)} hrs</div>
            <div className="w-[8%] text-center">@</div>
            <div className="w-[14%] text-right">$ {labor_rates[order][0].lbr_rate.toFixed(2)} /hr</div>
            <div className="w-[14%] text-right">{subtotals[order][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
        )
      }
    })
    return hour;
  }


  static hourly_mat = (subtotals, material_rates, sizing) => {
    var mat = Codes.get_mat_order().map((order, index)=>{
      if(order in subtotals){
        return (
          <div className="w-full flex" key={index} style={{marginBottom: sizing.totals.mb}}>
            <div className="w-[50%]">{Codes.get_label(order)}</div>
            <div className="w-[14%] text-right">{(subtotals[order][0].t_amt / material_rates[order][0].matl_rate).toFixed(1)} hrs</div>
            <div className="w-[8%] text-center">@</div>
            <div className="w-[14%] text-right">$ {material_rates[order][0].matl_rate.toFixed(2)} /hr</div>
            <div className="w-[14%] text-right">{subtotals[order][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
          </div>
        )
      }
    })
    return mat;
  }


  static misc = (subtotals, sizing) => {
    if('OTSL' in subtotals){
      return (
        <div className="w-full flex" style={{marginBottom: sizing.totals.mb}}>
          <div className="w-[50%]">Miscellaneous</div>
          <div className="w-[14%] text-right"></div>
          <div className="w-[8%] text-center"></div>
          <div className="w-[14%] text-right"></div>
          <div className="w-[14%] text-right">{subtotals['OTSL'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
        </div>
      )
    }
  }


  static tax = (totals, tax_rate, sizing) => {
    if('ALL' in tax_rate && 'F7' in totals){
      var tax_tot = totals['F7'][0].t_amt;
      var rate = tax_rate['ALL'][0].tax_rate;
      var reverse = (tax_tot / (rate / 100)).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      var disp_rate = rate.toFixed(4);
      var disp_tot = tax_tot.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      return (
        <div className="border-solid border-gray-900 flex" style={{marginBottom: sizing.totals.mbs, paddingBottom: sizing.totals.pbs, borderBottomWidth: sizing.totals.bb}}>
          <div className="w-[50%]">Sales Tax</div>
          <div className="w-[14%]">$ {reverse}</div>
          <div className="w-[8%]">@</div>
          <div className="w-[14%]">{disp_rate} %</div>
          <div className="w-[14%] text-right">{disp_tot}</div>
        </div>
      )
    }
  }


  static cust_subtotals = (totals, sizing) => {
    if('D2' in totals || 'BTR' in totals){
      var btr;
      var ded;
      if('BTR' in totals){
        var btr_total = totals['BTR'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        btr = (
          <div className="flex" style={{marginBottom: sizing.totals.mb}}>
            <div className="w-[50%]">Betterment</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right">{btr_total}</div>
          </div>
        )
      }
      if('D2' in totals){
        var ded_total = totals['D2'][0].t_amt.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        ded = (
          <div className="flex" style={{marginBottom: sizing.totals.mb}}>
            <div className="w-[50%]">Deductible</div>
            <div className="w-[14%]"></div>
            <div className="w-[8%]"></div>
            <div className="w-[14%]"></div>
            <div className="w-[14%] text-right">{ded_total}</div>
          </div>
        )
      }
      return (
        <div className="border-solid border-gray-900 w-full" style={{marginBottom: sizing.totals.mbs, borderBottomWidth: sizing.totals.bb}}>
          {ded}
          {btr}
        </div>
      )
    }
    return;
  }

  static search_result = (desc, result) => {
    var find = desc.slice(result.index, result.index + result.length);
    var before = desc.substring(0, result.index);
    var after = desc.substring(result.index + result.length);
    return <div><span>{before}</span><span className="bg-rose-400">{find}</span><span>{after}</span></div>;
  }

  static summary_mods = (line, mods) => {
    var summ = [];
    Object.keys(mods).forEach((key)=>{
      var quote = '';
      if(key == 'labor' || key == 'refinish'){
        quote = this.labor_mods(line[key], mods[key][0], key);
        summ.push(quote);
      }
      if(key == 'labor_flag'){
        quote = this.labor_flag_mods(line['labor'], mods[key][0], key);
        summ.push(quote);
      }
      if(key == 'price'){
        quote = this.price_mods(line['part'], mods[key][0], key);
        summ.push(quote);
      }
    })
    return summ;
  }

  static labor_mods = (line, mod, key) => {
    if(!line && mod.value == '???'){
      return RenderActions.cap_first(key) + ' time is missing.'
    }
    if(!line && mod.value != '???'){
      return RenderActions.cap_first(key) + ' time is missing. Change to ' + mod.value;
    }
    if(line && line.labor_incl_ind && mod.value == '???'){
      return RenderActions.cap_first(key) + ' time should not be included.';
    }
    if(line && line.labor_incl_ind && mod.value != '???'){
      return RenderActions.cap_first(key) + ' time should not be included. Change to ' + mod.value;
    }
    return 'Change ' + key + ' time from ' + line.labor_hours + ' to ' + mod.value;
  }


  static labor_flag_mods = (line, mod, key) => {
    if(line && !line.labor_flag){
      return 'Designate ' + Codes.get_designation(mod.value) + ' labor.';
    }
    if(line && line.labor_flag){
      return 'Change from ' + Codes.get_designation(line.labor_flag) + ' labor to ' + Codes.get_designation(mod.value) + ' labor.';
    }
    if(line && line.labor_flag && mod.value == ''){
      return 'Remove ' + Codes.get_designation(line.labor_flag) + ' labor designation.'
    }
  }

  static price_mods = (line, mod, key) => {
    if(!line && mod.value == '?????'){
      return 'Charge/Pricing is missing.'
    }
    if(!line && mod.value != '?????'){
      return 'Charge/Pricing is missing. Change to $' + mod.value;
    }
    if(line && line.price_incl_ind && mod.value == '?????'){
      return 'Charge/Pricing should not be included.';
    }
    if(line && line.price_incl_ind && mod.value != '?????'){
      return 'Charge/Pricing should not be included. Change to ' + mod.value;
    }
    return 'Change Charge/Pricing from $' + line.part_price + ' to $' + mod.value;
  }

  static cap_first = (text) => {
    return text.charAt(0).toUpperCase() + text.slice(1);
  }

}
