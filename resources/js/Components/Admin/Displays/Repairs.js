import React, { useState, useEffect } from 'react';

export default function Repairs({ repairs }) {
  

    return (
        <div className="w-full h-full flex justify-center">
          {repairs.map((repair, index)=>{
            return <div key={index}>{repair.unqfile_id}</div>
          })}
        </div>
    );
}
