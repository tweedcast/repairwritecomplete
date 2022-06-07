import React, { useState, useEffect } from 'react';
import SingleRepair from '@/Components/Admin/Displays/SingleRepair';

export default function Repairs({ repairs, setDisplay, organization, location }) {


    return (
        <div className="w-full h-full flex justify-center">
          {repairs.map((repair, index)=>{
            return <div key={index} onClick={()=>{setDisplay(<SingleRepair repair={repair} organization={organization} location={location}/>)}}>{repair.v_model_yr}</div>
            /*return (
              <div key={index} onClick={()=>{window.open(route('repair-review', {organization: organization, location: location, repair: repair.id}), 'window', 'toolbar=no', 'menubar=no')}}>
                {repair.v_makecode}
              </div>
              )*/
            //return <a href={routes('repair-review', {organization: organization, location: slug, repair: repair.id})} target="_blank" />
          })}
        </div>
    );
}
