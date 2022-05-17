import React from 'react';

export default function Location({ location, changeLocation, active, makeActive }) {
    return (
        <div className={"rounded-lg my-2 mx-2 px-4 py-2 bg-white cursor-pointer border-solid border-2 " + (active && 'border-yellow-300')}
              onClick={()=>{
                changeLocation(location.slug)
                makeActive(location.slug)
              }}>
              {location.name}
              </div>
    );
}
