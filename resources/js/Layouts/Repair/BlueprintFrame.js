import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faPlus, faMinus } from '@fortawesome/free-solid-svg-icons'

export default function BlueprintFrame({ repair, organization, location }){


  const [zoom, setZoom] = useState(100)

  useEffect(()=>{
    resizeIframe()
  })

  const zoom_in = () => {
    zoom < 100 && setZoom(zoom + 10)
    //resizeIframe()
  }

  const zoom_out = () => {
    zoom > 10 && setZoom(zoom - 10)
    //resizeIframe()
  }

  const resizeIframe = (e) => {
    var frame = document.getElementById('repair_frame')
    console.log(frame)
    frame.style.height = (frame.contentWindow.document.body.scrollHeight)+'px'
  }

  return (
    <div className="grow flex justify-center relative">
      <div className="absolute left-0 top-0 flex">
        <div onClick={()=>zoom_in()}><FontAwesomeIcon icon={faPlus} style={{fontSize: '22px'}}/></div>
        <div onClick={()=>zoom_out()}><FontAwesomeIcon icon={faMinus} style={{fontSize: '22px'}}/></div>
      </div>
      <iframe id="repair_frame" src={route('repair-review', {organization: organization, location: location, repair: repair.id})} className="select-none" style={{width: zoom + '%'}} scrolling="no" onLoad={(e)=>{resizeIframe(e)}}/>
    </div>
  )
}
