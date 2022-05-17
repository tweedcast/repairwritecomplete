import React from 'react';

export default function Empty() {
    return (
        <div className="w-full h-full flex justify-center">
          <div className="flex flex-col justify-center">
            <div className="rounded-lg shadow-lg bg-white p-8">
              Select a location to get started.
            </div>
          </div>
        </div>
    );
}
