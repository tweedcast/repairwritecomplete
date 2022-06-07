import React from 'react';
import HeaderLine from '@/Components/Repair/CCCOne/HeaderLine';
import ChildLine from '@/Components/Repair/CCCOne/ChildLine';
import DefaultLine from '@/Components/Repair/CCCOne/DefaultLine';
import { Circles } from 'react-loader-spinner';

export default function Lines({ lines, docVerCode, docVerNum, addSugg, newSugg, setNewSugg, refreshLines, searchResults, sizing }){

  const render_line = (line, index) => {
    if(line.is_header){
      return <HeaderLine
                id={line.id}
                key={index}
                lineNo={line.line_num}
                lineDesc={line.line_desc}
                sizing={sizing}
                />
    }
    if(line.is_child){
      return <ChildLine
                id={line.id}
                key={index}
                docVerCode={docVerCode}
                docVerNum={docVerNum}
                lineVerCode={line.estimate_ver_code}
                lineNo={line.line_num}
                lineDesc={line.line_desc}
                part={line.part}
                labor={line.labor}
                refinish={line.refinish}
                sizing={sizing}
                addSugg={addSugg}
                newSugg={newSugg}
                setNewSugg={setNewSugg}
                suggestions={line.suggestions}
                refreshLines={refreshLines}
                searchResult={(searchResults && line.id in searchResults) ? searchResults[line.id] : null}
                />
    }
    return <DefaultLine
              key={index}
              id={line.id}
              version={line.estimate_ver_code}
              isSublet={line.manual_line_ind}
              docVerCode={docVerCode}
              docVerNum={docVerNum}
              lineVerCode={line.estimate_ver_code}
              lineNo={line.line_num}
              lineDesc={line.line_desc}
              part={line.part}
              labor={line.labor}
              refinish={line.refinish}
              manual={line.manual_line_ind}
              addSugg={addSugg}
              newSugg={newSugg}
              setNewSugg={setNewSugg}
              suggestions={line.suggestions}
              refreshLines={refreshLines}
              mods={line.modifications}
              searchResult={(searchResults && line.id in searchResults) ? searchResults[line.id] : null}
              sizing={sizing}
              />
  }

  return (
    lines ?
    <div>
      {lines.map((line, index)=>{
          return render_line(line, index)
        })}
    </div> :
    <Circles height={100} width={100} />
  )
}
