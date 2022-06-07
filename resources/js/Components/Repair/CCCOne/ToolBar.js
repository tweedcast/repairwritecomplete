import React, { useState } from 'react';
import Search from '@/Components/Repair/CCCOne/Search';
import Zoom from '@/Components/Repair/CCCOne/Zoom';
import Summary from '@/Components/Repair/CCCOne/Summary';

export default function ToolBar({ runSearch, results, zoomIn, zoomOut, zoom, lines }){
  return (
    <div className="sticky top-0 left-0 flex p-4 z-10">
      <Search runSearch={runSearch} results={results} />
      <Zoom zoomIn={zoomIn} zoomOut={zoomOut} zoom={zoom}/>
      <Summary lines={lines}/>
    </div>
  )
}
