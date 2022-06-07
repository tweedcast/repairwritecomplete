import React, { useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faDeleteLeft } from '@fortawesome/free-solid-svg-icons';

export default function SuggestionLine({ desc, sizing, suggId, refreshLines }){
  const [removing, setRemoving] = useState(false);

  const remove = async (mod) => {
    const data = await axios.post(route('remove-line-suggestion'), {
      sugg_id: suggId,
    }).catch((error)=>{
      console.log(error)
    })
    return data;
  }

  const handleRemove = () => {
    setRemoving(true)
    const removed = remove();
    removed && refreshLines();
  }

  return (
    <div className="bg-sky-300 flex select-none relative" style={{padding: sizing.suggestionLine.p}}>
      <div className="flex flex-col justify-center w-[4%]">
        <FontAwesomeIcon icon={faDeleteLeft} className="rotate-180 mr-2 text-white cursor-pointer hover:text-red-600" style={{fontSize: sizing.suggestionLine.t}} onClick={()=>handleRemove()}/>
      </div>
      <div className="w-[18%]">Suggested: </div>
      <div className="w-[26%]">{desc}</div>
      {removing && <div className="absolute h-full w-full left-0 top-0" style={{backgroundColor: '#ffffffb3'}}></div>}
    </div>
  )
}
