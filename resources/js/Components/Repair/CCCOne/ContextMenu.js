import React from 'react';
import {default as Rend} from '@/Components/Repair/CCCOne/RenderActions';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faArrowRotateLeft } from '@fortawesome/free-solid-svg-icons'

export default function ContextMenu({ mouse, closeContext, orig, removeMod, sizing }){


  return (
    <div>
      <div className='bg-white absolute w-[50px] h-[50px] right-0 top-[-12vh] z-20 rounded-tl-md rounded-bl-md rounded-tr-md min-h-[12vh] min-w-[10vw] text-left p-[0.4vw] text-[1vw]'>
        <div className="mb-[0.4vw] flex justify-center">
          <div className="p-[0.2vw]">Original: </div>
          <div className="p-[0.2vw] rounded-md border-[0.1vw] border-black border-solid">{(orig == '' || !orig) ? 'Blank' : orig}</div>
        </div>
        <div className="p-[0.2vw] flex justify-center">
          <div className="p-[0.2vw] rounded-md border-[0.1vw] border-solid hover:border-red-600 cursor-pointer" onClick={()=>removeMod()}>Reset <FontAwesomeIcon icon={faArrowRotateLeft} style={{fontSize: '20px'}}/></div>
        </div>
      </div>
      <div className="fixed top-0 left-0 w-[100vw] h-[100vh] z-10 bg-[#0000001c]" onClick={closeContext} onContextMenu={closeContext}></div>
    </div>
  )
}
