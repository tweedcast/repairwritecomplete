import React, { useState, Fragment } from 'react';
import { Listbox } from '@headlessui/react'

export default function Search({ runSearch, results }){
  const [term, setTerm] = useState('');
  const [lineSelected, setLineSelected] = useState(null);

  const handleChange = (e) => {
    setTerm(e.target.value)
  }

  const handleEnter = (e) => {
    if(e.key === 'Enter'){
      e.target.blur()
    }
  }

  const handleBlur = (e) => {
    runSearch(term)
  }

  const scrollTo = (e) => {
    console.log('line_' + e);
    document.getElementById("line_" + e).scrollIntoView({behavior: "smooth", block: "end"});
    setLineSelected(e)
  }

  return (
    <div className="sm:w-[100vw] md:w-1/3 relative mr-2">
      <div className="px-2 py-1 bg-slate-500">
        <div className="flex">
          <div className="flex items-center mr-[0.4vw] text-white">Search: </div>
          <input type="text" value={term} onChange={handleChange} onBlur={handleBlur} onKeyUp={handleEnter} className="p-[0.2vw] decoration-none appearance-none w-full text-left border-none outline-none bg-white focus:ring-white focus:border-white focus:shadow-outline"></input>
        </div>
    </div>
    {results &&
      <div className="absolute p-3 flex items-start" style={{backgroundColor: '#64748ba6'}}>
        <div className="text-white mr-2">{Object.keys(results).length} results found</div>
        {Object.keys(results).length > 0 &&
        <Listbox value={lineSelected} onChange={(e)=>scrollTo(e)}>
        <Listbox.Button className="text-white underline mr-2">Scroll to line</Listbox.Button>
        <Listbox.Options>
          {Object.keys(results).map((res) => (
            /* Use the `active` state to conditionally style the active option. */
            /* Use the `selected` state to conditionally style the selected option. */
            <Listbox.Option key={res} value={res} as={Fragment}>
              {({ active, selected }) => (
                <li
                  className={'p-[0.2vw] mb-[0.2vw] cursor-pointer bg-white'}
                >
                  {results[res].line_num + ' ' + results[res].desc}
                </li>
              )}
            </Listbox.Option>
          ))}
        </Listbox.Options>
      </Listbox>}
    </div>}
  </div>
  )
}
