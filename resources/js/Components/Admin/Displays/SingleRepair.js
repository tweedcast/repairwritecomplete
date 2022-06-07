import React, { useState, useEffect } from 'react';
import CCCOne from '@/Layouts/Repair/CCCOne';
import BlueprintFrame from '@/Layouts/Repair/BlueprintFrame';

export default function SingleRepair({ repair, organization, location }) {
  const [zoom, setZoom] = useState(0);
    return (
        <div className="w-full h-full">
          {/*<div className="w-1/6 flex"></div>*/}
          {repair.est_system === 'CCC ONE' ?
            <CCCOne repair={repair} /> : ''
            /*<BlueprintFrame repair={repair} organization={organization} location={location} />*/
          }
        </div>
    );
}
