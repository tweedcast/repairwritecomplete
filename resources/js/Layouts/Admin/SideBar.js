import React from 'react';
import NavLink from '@/Components/NavLink';
import LocationList from '@/Layouts/Admin/LocationList';

export default function SideBar({ locations, changeLocation }) {


    return (
        <div className="w-full flex flex-row pt-3">

          <LocationList locations={locations} changeLocation={changeLocation}/>
        </div>
    );
}
