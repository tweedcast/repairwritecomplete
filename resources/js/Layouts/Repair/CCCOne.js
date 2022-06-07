import React, { useState, useEffect } from 'react';
import Header from '@/Components/Repair/CCCOne/Header';
import PageTop from '@/Components/Repair/CCCOne/PageTop';
import Estimator from '@/Components/Repair/CCCOne/Estimator';
import ClaimInfo from '@/Components/Repair/CCCOne/ClaimInfo';
import ContactInfo from '@/Components/Repair/CCCOne/ContactInfo';
import VehicleInfo from '@/Components/Repair/CCCOne/VehicleInfo';
import VehicleOptions from '@/Components/Repair/CCCOne/VehicleOptions';
import VehicleDisplay from '@/Components/Repair/CCCOne/VehicleDisplay';
import LineHeader from '@/Components/Repair/CCCOne/LineHeader';
import Lines from '@/Components/Repair/CCCOne/Lines';
import LineFooter from '@/Components/Repair/CCCOne/LineFooter';
import Totals from '@/Components/Repair/CCCOne/Totals';
import ToolBar from '@/Components/Repair/CCCOne/ToolBar';
import Sizing from '@/Layouts/Repair/Sizing';

export default function CCCOne({ repair }){
  const [lines, setLines] = useState(null);
  const [options, setOptions] = useState(null);
  const [opt_lay, setOptLay] = useState(null);
  const [totals, setTotals] = useState(null);
  const [newSugg, setNewSugg] = useState(null);
  const [searchMatch, setSearchMatch] = useState(null);
  const [zoom, setZoom] = useState(100);

  useEffect(()=>{
    if(!lines){
      get_lines()
    }
    if(!opt_lay){
      get_options()
    }
    if(!totals){
      get_totals()
    }
  })

  const get_lines = async () => {
    const lines = await axios.post(route('repair-repair-lines', {repair_id: repair.id}));
    setLines(lines.data);
    return lines;
  }

  const get_options = () => {
    axios.post(route('repair-repair-options', {repair_id: repair.id}))
      .then((response)=>{
        setOptions(response.data.options)
        setOptLay(response.data.layout)
      }).catch((error)=>{
        console.log(error)
      })
  }

  const get_totals = () => {
    axios.post(route('repair-repair-totals', {repair_id: repair.id}))
      .then((response)=>{
        setTotals(response.data)
      }).catch((error)=>{
        console.log(error)
      })
  }


  const addSugg = async (id, docCode, docVer, lineVer) => {
    if(newSugg.desc.trim() != ''){
      const data = await axios.post(route('add-line-suggestion'), {
        line_id: id,
        description: newSugg.desc,
        doc_code: docCode,
        doc_ver: docVer,
        line_ver: lineVer,
      }).catch((error)=>{
        console.log(error)
      })
      return data;
    } else {
      return Promise.resolve('Empty');
    }
  }

  const search = (word) => {
    var lower = word.toLowerCase()
    var length = word.length
    var new_matches = {};
    if(word == ''){
      setSearchMatch(null)
    } else {
      lines.forEach((line)=>{
        var index = line.line_desc.toLowerCase().indexOf(lower);
        if(index > -1 && !line.is_header){
          new_matches[line.id] = {index: index, length: length, line_num: line.line_num, desc: line.line_desc}
        }
      })
      setSearchMatch(new_matches)
    }
  }

  const zoom_in = () => {
    zoom < 200 && setZoom(zoom + 10)
    //resizeIframe()
  }

  const zoom_out = () => {
    zoom > 10 && setZoom(zoom - 10)
    //resizeIframe()
  }

  const sizing = Sizing(zoom);

  return (
    <div className="lg:p-6 relative w-full">
      <ToolBar runSearch={search} results={searchMatch} zoom={zoom} zoomIn={zoom_in} zoomOut={zoom_out} lines={lines}/>
      <div className={`flex flex-col ${zoom <= 100 && 'items-center'}`}>
        <div className="shadow-2xl bg-white" style={{fontFamily: 'Verdana Pro', width: sizing.page.w, padding: sizing.page.p, fontSize: sizing.page.t, height: sizing.page.h}}>
        <Header
          rfName={repair.rf_name}
          rfAddress1={repair.rf_address_1}
          rfAddress2={repair.rf_address_2}
          rfCity={repair.rf_city}
          rfState={repair.rf_state}
          rfZip={repair.rf_zip}
          rfPhone={repair.rf_phone}
          sizing={sizing}
           />
         <PageTop
           first={repair.ownr_fn}
           last={repair.ownr_ln}
           ro={repair.ro_id}
           docVerCode={repair.document_ver_code}
           docVerNum={repair.document_ver_num}
           docStatus={repair.document_status}
           sizing={sizing}
           />
         <Estimator first={repair.estimator_fn} last={repair.estimator_ln} sizing={sizing}/>
        <ClaimInfo first={repair.ownr_fn} last={repair.ownr_ln} claimNo={repair.clm_no} sizing={sizing}/>
        <ContactInfo
          first={repair.ownr_fn}
          last={repair.ownr_ln}
          phone={repair.ownr_phone}
          rfName={repair.rf_name}
          rfAddress1={repair.rf_address_1}
          rfAddress2={repair.rf_address_2}
          rfCity={repair.rf_city}
          rfState={repair.rf_state}
          rfZip={repair.rf_zip}
          rfPhone={repair.rf_phone}
          insName={repair.ins_company_name}
          sizing={sizing}
          />
        <VehicleInfo
          vin={repair.v_vin}
          year={repair.v_model_yr}
          make={repair.v_makecode}
          model={repair.v_model}
          style={repair.v_style}
          color={repair.v_color}
          prodDate={repair.v_prod_dt}
          mileage={repair.v_mileage}
          ro={repair.ro_id}
          sizing={sizing}
          />
        <VehicleOptions options={opt_lay} sizing={sizing}/>
        </div>

        <div className="shadow-2xl bg-white w-full" style={{fontFamily: 'Verdana Pro', width: sizing.page.w, padding: sizing.page.p, fontSize: sizing.page.t}}>
          <PageTop
            first={repair.ownr_fn}
            last={repair.ownr_ln}
            ro={repair.ro_id}
            docVerCode={repair.document_ver_code}
            docVerNum={repair.document_ver_num}
            docStatus={repair.document_status}
            sizing={sizing}
            />
          <VehicleDisplay
            year={repair.v_model_yr}
            make={repair.v_makecode}
            model={repair.v_model}
            style={repair.v_style}
            color={repair.v_color}
            sizing={sizing}
            />
          <LineHeader sizing={sizing}/>
          <Lines
            lines={lines}
            searchResults={searchMatch}
            docVerCode={repair.document_ver_code}
            docVerNum={repair.document_ver_num}
            addSugg={addSugg}
            newSugg={newSugg}
            setNewSugg={setNewSugg}
            refreshLines={get_lines}
            sizing={sizing}
            />
          <LineFooter totals={totals} sizing={sizing}/>

          <Totals totals={totals} sizing={sizing}/>
        </div>
      </div>
    </div>
  )
}
