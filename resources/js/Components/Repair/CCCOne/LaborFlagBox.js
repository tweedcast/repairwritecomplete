import React, { useState } from 'react';
import ContextMenu from '@/Components/Repair/CCCOne/ContextMenu';

export default function LaborFlagBox({ disp, orig, mod, modId, addUpdate, refreshLines, removeMod, sizing }){
  const [modify, setModify] = useState(false);
  const [modVal, setModVal] = useState(null);
  const [dirty, setDirty] = useState(false);
  const [showContext, setShowContext] = useState(false)
  const [changing, setChanging] = useState(false);

  const changeModVal = (e) => {
    setDirty(true)
    var new_value;
    var t = e.target.value;
    if(t == 'm' || t == 'M'){
      new_value = 'M'
    } else if(t == 's' || t == 'S'){
      new_value = 'S'
    } else if(t == 'g' || t == 'G'){
      new_value = 'G'
    } else if(t == 'e' || t == 'E'){
      new_value = 'E'
    } else if(t == 'd' || t == 'D'){
      new_value = 'D'
    } else if(t == 'f' || t == 'F'){
      new_value = 'F'
    } else {
      new_value = '';
    }
    setModVal(new_value)
  }

  const startMod = () => {
    mod ? setModVal(mod) : setModVal(orig)
    setModify(true)

  }

  const stopMod = () => {
      if(mod && mod == modVal || !mod && orig == modVal){
        refresh()
      } else if(mod && orig == modVal){
        setChanging(true)
        remove()
      } else {
        setChanging(true)
        handleAddUpdate()
      }
  }

  const handleAddUpdate = async () => {
    const add = await addUpdate('labor_flag', modVal);
    add && reLine();
  }

  const handleEnter = (event) => {
    if(event.key === 'Enter'){
      event.target.blur()
    }
  }

  const reLine = async () => {
    const lines = await refreshLines();
    lines && refresh()
  }

  const refresh = () => {
    setDirty(false)
    setModify(false)
    setModVal(null)
    setChanging(false)
  }

  const dispContext = (e) => {
    e.preventDefault()
    setShowContext(true)
  }

  const closeContext = () => {
    setShowContext(false)
  }

  const remove = async () => {
    setChanging(true)
    setShowContext(false)
    const removed = await removeMod(modId);
    removed && reLine();
  }

  return (

      <div className={"cursor-default relative w-[6%] text-left " + (mod ? 'bg-yellow-500' : 'hover:bg-yellow-500')} style={{padding: sizing.defaultLine.p}} onClick={()=>startMod()} onContextMenu={(e)=>{mod && dispContext(e)}}>
        <div>
          {modify ? <input
                      className="decoration-none appearance-none w-full text-left outline-none bg-transparent"
                      value={modVal ? modVal : ''}
                      onKeyUp={(e)=>handleEnter(e)}
                      onChange={(e)=>changeModVal(e)}
                      onBlur={(e)=>stopMod(e)}
                      maxLength='1'>
                    </input>
          : (dirty ? modVal : (mod ? mod : disp))}
        </div>
        {showContext && <div className="absolute w-full h-full top-0 left-0 border-x-[0.2vw] border-b-[0.2vw] border-white border-solid z-20"></div>}
        {showContext && <ContextMenu closeContext={closeContext} orig={disp} removeMod={remove}/>}
        {changing && <div className="absolute h-full w-full left-0 top-0" style={{backgroundColor: '#ffffffb3'}}></div>}
      </div>

  )
}
