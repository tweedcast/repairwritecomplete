import React, { useState } from 'react';
import SideBar from '@/Layouts/Admin/SideBar';
import Empty from '@/Components/Admin/Displays/Empty';
import Repairs from '@/Components/Admin/Displays/Repairs';

export default function AdminFrame({ locations }) {
  const [display, setDisplay] = useState(<Empty />);

    const changeLocation = (slug) => {
      axios.get(route('location-repair-list', {location: slug}))
        .then((response)=>{
          setDisplay(<Repairs repairs={response.data} />)
        }).catch((error)=>{
          console.log(error)
        })
    }

    return (
      <div className="flex flex-col grow">
        <SideBar locations={locations} changeLocation={changeLocation}/>
          <div className="w-screen h-full m-2">
              {display}
          </div>
      </div>
    );
}
