import React, { useState } from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';
import SuggestionLine from '@/Components/Repair/CCCOne/SuggestionLine';
import NewSuggestion from '@/Components/Repair/CCCOne/NewSuggestion';

export default function ChildLine({
    id,
    docVerCode,
    docVerNum,
    lineVerCode,
    lineNo,
    lineDesc,
    part,
    labor,
    refinish,
    sizing,
    addSugg,
    newSugg,
    setNewSugg,
    suggestions,
    refreshLines,
    searchResult,
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

  return (
    <div id={'line_' + id}>
      <div className="flex w-full">
        <div className="w-[6%] text-center" style={{padding: sizing.childLine.p}}>{lineNo}</div>
        <div className="w-[4%]" style={{padding: sizing.childLine.p}}></div>
        <div className="w-[6%]" style={{padding: sizing.childLine.p}}>{Rend.supp_ind(docVerCode, docVerNum, lineVerCode)}</div>
        <div className="w-[6%] text-right font-bold" style={{padding: sizing.childLine.p}}></div>
        <div className="w-[26%]" style={{padding: sizing.childLine.ps}} onContextMenu={handleClick}>{searchResult ? Rend.search_result(lineDesc, searchResult) : lineDesc}</div>
        <div className="w-[14%] text-right" style={{padding: sizing.childLine.p}}>{part && part.part_num}</div>
        <div className="w-[4%] text-right" style={{padding: sizing.childLine.p}}>{part && part.quantity}</div>
        <div className="w-[10%] text-right" style={{padding: sizing.childLine.p}}>{part && Rend.part_price(part)}</div>
        <div className="w-[3%]" style={{padding: sizing.childLine.p}}></div>
        <div className="w-[3%]" style={{padding: sizing.childLine.p}}></div>
        <div className="w-[6%] text-right" style={{padding: sizing.childLine.p}}>{labor && Rend.labor(labor)}</div>
        <div className="w-[6%]" style={{padding: sizing.childLine.p}}></div>
        <div className="w-[6%] text-right" style={{padding: sizing.childLine.p}}>{refinish && Rend.labor(refinish)}</div>
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
