import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faPlus, faMinus } from '@fortawesome/free-solid-svg-icons'

export default function Zoom({ zoom, zoomIn, zoomOut }){
  return (
    <div className="flex px-2 py-1 flex bg-slate-500 mr-2">
      <div className="bg-white mr-1 flex flex-col justify-center select-none cursor-pointer px-2" onClick={()=>zoomIn()}><FontAwesomeIcon icon={faPlus} style={{fontSize: '22px'}}/></div>
      <div className="bg-white mr-1 flex flex-col justify-center select-none cursor-pointer px-2" onClick={()=>zoomOut()}><FontAwesomeIcon icon={faMinus} style={{fontSize: '22px'}}/></div>
      <div className="text-white flex flex-col justify-center select-none px-2">{zoom}%</div>
    </div>
  )
}
