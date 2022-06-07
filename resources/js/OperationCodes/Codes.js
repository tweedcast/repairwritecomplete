const TOTALS_PARTS = {
  PAL:	'Parts - Like Kind and Quality (LKQ)',
  PAM:	'Parts - Remanufactured',
  PAMU:	'Parts - Used Mobile Electronics',
  PAN:	'Parts - New',
  PAND:	'Parts - New OEM discounted',
  PANM:	'Parts - New Mobile Electronics',
  PAO:	'Parts - Other',
  PAR:	'Parts - Re-cored',
  PASL:	'Parts - Sublet',
  PA:	'Parts',
  PAA:	'Parts - Aftermarket (QRP)',
  PAC:	'Parts - Rechromed',
  PAG:	'Parts - Glass',
  RPPA:	'Parts - Related Prior Damage',
  UPPA:	'Parts - UnRelated Prior Damage',
  PAGD:	'Glass - Driver Side',
  PAGF:	'Glass - Front',
  PAGN:	'New Non-OEM Glass',
  PAGP:	'Glass - Passenger Side',
  PAGQ:	'Glass - Quarter Glass',
  PAGR:	'Glass - Rear',
}

const TOTALS_LABOR = {
  LA:	'Labor',
  LAA:	'Labor - Aluminum',
  LAAA:	'Labor - Aluminum, Additional Labor',
  LAAS:	'Labor - Aluminum, Sublet',
  LAB:	'Labor - Body',
  LABA:	'Labor - Body, Additional Labor',
  LABS:	'Labor - Body, Sublet',
  LAD:	'Labor - Diagnostic',
  LADT:	'Labor - Drill Time',
  LAE:	'Labor - Electrical',
  LAE2:	'Labor, 2 stage edge',
  LAEA:	'Labor - Electrical, Addional Labor',
  LAET:	'Labor - Edging Time',
  LAF:	'Labor - Frame',
  LAFS:	'Labor - Frame, Sublet',
  LAFA:	'Labor - Frame, Additional Labor',
  LAG:	'Labor - Glass',
  LAGA:	'Labor - Glass, Additional Labor',
  LAGS:	'Labor - Glass, Sublet',
  LAI:	'Labor - Installation & Wiring',
  LAM:	'Labor - Mechanical',
  LAMA:	'Labor - Mechanical, Additional Labor',
  LAMS:	'Labor - Mechanical, Sublet',
  LAP:	'Labor - Paintless Dent Repair',
  LAPA:	'Labor - Paintless Dent Repair, Additional Labor',
  LAPS:	'Labor - Paintless Dent Repair, Sublet',
  LAS:	'Labor - Structural',
  LASA:	'Labor - Structural, Additional Labor',
  LASS:	'Labor - Structural, Sublet',
}

const TOTALS_PAINT = {
  LAE3:	'3 Stage Edge',
  LAR:	'Labor - Refinish',
  LARA:	'Labor - Refinish, Additional Labor',
  LARN:	'Refinish, No Materials',
  LARS:	'Labor - Refinish, Sublet',
  LASU:	'Labor - Surface',
  LATT:	'Labor 2 Tone',
  LAUT:	'Labor - Underside Time',
  REFT:	'Refinish Total',
  RLA:	'Labor - Related Prior Damage',
  RLAB:	'Labor - Body Related Prior Damage',
  RLAR:	'Labor - Refinish Related Prior Damage',
  LA2S:	'Labor - 2 Stage',
  LA2U:	'Labor - 2 Stage Setup',
  LA3:	'User Defined Labor 3',
  LA3S:	'Labor - 3 Stage',
  LA3U:	'Labor - 3 Stage Setup',
}

const TOTALS_MISC = {
  OT1:	'Other - User Defined 1',
  OT2:	'Other - User Defined 2',
  OT4:	'Other - User Defined 4',
  OT3:	'Other - User Defined 3',
  OTAA:	'Other - Appearance Allowance',
  OTAC:	'Other - Additional Cost',
  OTAD:	'Other Appearance Allowance Less Deductible',
  OTCO:	'Other - Core',
  OTCR:	'Other - Customer Responsibility',
  OTDP:	'Other - ',
  OTF:	'Other - Shipping and Handling',
  OTFS:	'Other - Fuel Surcharge, Mileage',
  OTME:	'Other Mobile Electronics',
  OTML:	'Other - Mileage',
  OTPB:	'Primary Tow Bill',
  OTRS:	'Emergency Road Service',
  OTSB: 'Secondary Tow Bill',
  OTSG:	'Other - Sublet Glass',
  OTSL:	'Other - Sublet',
  OTST:	'Other - Storage',
  OTTL:	'Total Loss Settlement Charges',
  OTTR:	'Temporary Repairs',
  OTTW:	'Other - Towing',
  OTUM:	'Other - Undercoating Materials',
}

const LABOR_ORDER = [
  'LAB',
  'LAR',
  'LAM',
  'LAF',
  'LAS',
  'LAA'
];

const MAT_ORDER = [
  'MAPA',
  'MASH'
];

const HOURLY_LABELS = {
  LAB: 'Body Labor',
  LAR: 'Paint Labor',
  LAM: 'Mechanical Labor',
  LAF: 'Frame Labor',
  LAS: 'Structural Labor',
  LAA: 'Aluminum Labor',
  LAG: 'Glass Labor',
  LAD: 'Diagnostic Labor',
  LAE: 'Electrical Labor',
  MAPA: 'Paint Supplies',
  MASH: 'Body Supplies'
}

const LABOR_DESIGNATE = {
  M: 'Mechanical',
  F: 'Frame',
  S: 'Structural',
  G: 'Glass',
  E: 'Electrical',
  D: 'Diagnostic'
}



export default class Codes {

  static get_label(type){
    return HOURLY_LABELS[type];
  }

  static aggregate(totals, part_rate){
    var parts = 0;
    var labor = 0;
    var paint = 0;
    Object.keys(totals).forEach((key)=>{
      if(key in TOTALS_PARTS || key in TOTALS_MISC){
        var part_total = totals[key][0].t_amt;
        if(key in part_rate){
          var pct = (100 - part_rate[key][0].adj_pct) / 100;
          part_total = part_total / pct;
        }
        parts = parts + part_total
      }
      if(key in TOTALS_LABOR){
        labor = labor + totals[key][0].t_hrs
      }
      if(key in TOTALS_PAINT){
        paint = paint + totals[key][0].t_hrs
      }
    })
    return {parts: parts, labor: labor, paint: paint}
  }

  static agg_repl_parts(totals, part_rate){
    var parts = 0;
    Object.keys(totals).forEach((key)=>{
      if(key in TOTALS_PARTS){
        var part_total = totals[key][0].t_amt;
        if(key in part_rate){
          var pct = (100 - part_rate[key][0].adj_pct) / 100;
          part_total = part_total / pct;
        }
        parts = parts + part_total
      }
    })
    return {parts: parts};
  }

  static get_labor_order(){
    return LABOR_ORDER;
  }

  static get_mat_order(){
    return MAT_ORDER;
  }

  static get_designation(flag){
    return LABOR_DESIGNATE[flag];
  }
}
