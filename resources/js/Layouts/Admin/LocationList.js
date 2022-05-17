import React, { useState } from 'react';
import Location from '@/Components/Admin/SideBar/Location';

export default function LocationList({ locations, changeLocation }) {
  const [active, setActive] = useState(null);

    return (
        <div className="w-100 flex flex-row">
          {locations.map((location)=>{
            return <Location location={location} changeLocation={changeLocation} active={active === location.slug} makeActive={setActive}/>
          })}
        </div>
    );
}
