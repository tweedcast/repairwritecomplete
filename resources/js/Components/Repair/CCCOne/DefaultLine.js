import React, { useState } from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';
import LaborBox from '@/Components/Repair/CCCOne/LaborBox';
import RefinishBox from '@/Components/Repair/CCCOne/RefinishBox';
import LaborFlagBox from '@/Components/Repair/CCCOne/LaborFlagBox';
import PriceBox from '@/Components/Repair/CCCOne/PriceBox';
import SuggestionLine from '@/Components/Repair/CCCOne/SuggestionLine';
import NewSuggestion from '@/Components/Repair/CCCOne/NewSuggestion';

export default function DefaultLine({
    id,
    version,
    docVerCode,
    docVerNum,
    lineVerCode,
    lineNo,
    lineDesc,
    isSublet,
    manual,
    part,
    labor,
    refinish,
    addSugg,
    newSugg,
    setNewSugg,
    suggestions,
    mods,
    refreshLines,
    searchResult,
    sizing
  }){

  const [adding, setAdding] = useState(false)

  const handleClick = (e) => {
    e.preventDefault()
    if(e.nativeEvent.button === 2){
      if(!newSugg){
        setNewSugg({line_id: id, desc: ''})
      }
    }
  }

  const handleChange = (e) => {
    if(newSugg){
      var temp = {...newSugg};
      temp.desc = e.target.value;
      setNewSugg(temp);
    }
  }

  const handleEnter = async (e) => {
    if(e.key === 'Enter'){
      setAdding(true)
      const added = await handleAddSugg(id, docVerCode, docVerNum, lineVerCode)
      added && refresh({line_id: id, desc: ''})
    }
  }

  const handleBlur = async () => {
    setAdding(true)
    const added = await handleAddSugg(id, docVerCode, docVerNum, lineVerCode)
    added && refresh(null)
  }

  const handleAddSugg = async (id, docVerCode, docVerNum, lineVerCode) => {
    const add = await addSugg(id, docVerCode, docVerNum, lineVerCode);
    return add;
  }

  const refresh = async (sugg) => {
    const lines = await refreshLines();
    lines && setNewSugg(sugg)
    lines && setAdding(false)
  }

  const addUpdateMod = async (type, value) => {
    const data = await axios.post(route('add-line-modification'), {
      line_id: id,
      value: value,
      type: type,
      doc_code: docVerCode,
      doc_ver: docVerNum,
      line_ver: lineVerCode,
    }).catch((error)=>{
      console.log(error)
    })
    return data;
  }

  const removeMod = async (mod) => {
    const data = await axios.post(route('remove-line-modification'), {
      mod_id: mod,
    }).catch((error)=>{
      console.log(error)
    })
    return data;
  }




  return (
    <div id={'line_' + id}>
      <div className={"flex w-full  " + (!Array.isArray(mods) && 'bg-yellow-300')}>
        <div className="w-[6%] text-center" style={{padding: sizing.defaultLine.p}}>{lineNo}</div>
        <div className="w-[4%]" style={{padding: sizing.defaultLine.p}}>{Rend.line_ind(manual, part, labor, refinish)}</div>
        <div className="w-[6%]" style={{padding: sizing.defaultLine.p}}>{Rend.supp_ind(docVerCode, docVerNum, lineVerCode)}</div>
        <div className="w-[6%] text-right" style={{padding: sizing.defaultLine.p}}>{Rend.line_oper(isSublet, manual, labor, part, refinish)}</div>
        <div className="w-[26%]" style={{padding: sizing.defaultLine.p}} onContextMenu={handleClick}>{searchResult ? Rend.search_result(lineDesc, searchResult) : lineDesc}</div>
        <div className="w-[14%] text-right" style={{padding: sizing.defaultLine.p}}>{part && part.part_num}</div>
        <div className="w-[4%] text-right" style={{padding: sizing.defaultLine.p}}>{part && part.quantity}</div>
        {/*<div className="w-[10%] text-right p-[0.5vw]">{part && Rend.part_price(part)}</div>*/}
        <PriceBox
          refreshLines={refreshLines}
          addUpdate={addUpdateMod}
          disp={part && Rend.part_price(part)}
          orig={part && (part.price_incl_ind ? 'Incl.' : part.part_price)}
          mod={(mods && mods.price) && mods.price[0].value}
          modId={(mods && mods.price) && mods.price[0].id}
          removeMod={removeMod}
          sizing={sizing}
          />
        <div className="w-[3%]" style={{padding: sizing.defaultLine.p}}>{part && !part.taxable ? 'X' : ''}</div>
        <div className="w-[3%]" style={{padding: sizing.defaultLine.p}}>{labor && Rend.database_labor_type(labor)}</div>
        <LaborBox
          refreshLines={refreshLines}
          addUpdate={addUpdateMod}
          disp={labor && Rend.labor(labor)}
          orig={labor && (labor.labor_incl_ind ? 'Incl.' : labor.labor_hours)}
          mod={(mods && mods.labor) && mods.labor[0].value}
          modId={(mods && mods.labor) && mods.labor[0].id}
          removeMod={removeMod}
          sizing={sizing}
          />
        {/*<div className="w-[6%] p-[0.5vw]">{labor && labor.labor_flag}</div>*/}
        <LaborFlagBox
          refreshLines={refreshLines}
          addUpdate={addUpdateMod}
          disp={labor && labor.labor_flag}
          orig={labor && labor.labor_flag}
          mod={(mods && mods.labor_flag) && mods.labor_flag[0].value}
          modId={(mods && mods.labor_flag) && mods.labor_flag[0].id}
          removeMod={removeMod}
          sizing={sizing}
          />
        <RefinishBox
          refreshLines={refreshLines}
          addUpdate={addUpdateMod}
          disp={refinish && Rend.labor(refinish)}
          orig={refinish && (refinish.labor_incl_ind ? 'Incl.' : refinish.labor_hours)}
          mod={(mods && mods.refinish) && mods.refinish[0].value}
          modId={(mods && mods.refinish) && mods.refinish[0].id}
          removeMod={removeMod}
          sizing={sizing}
          />

      </div>
      {suggestions &&
        suggestions.map((sugg, index)=>{
          return <SuggestionLine key={index} desc={sugg.description} sizing={sizing} suggId={sugg.id} refreshLines={refreshLines}/>
        })
        }
      {(newSugg && newSugg.line_id == id) && <NewSuggestion desc={newSugg.desc} adding={adding} handleChange={handleChange} handleEnter={handleEnter} handleBlur={handleBlur} sizing={sizing}/>}
    </div>
  )
}
