import React, { useState } from 'react'
import C from './C'

export default function B({aler,mes}) {
  const [data, setdata] = useState({
      farhan: "Fb",
      age: 21,
      friend: {
        ali: "police",
        asif: "developer",
      },
    });
    const [dataarr, setdataarr] = useState([
      { nam: "Farhan", ag: 21 },
      { nam: "Asif", ag: 29 },
      { nam: "Sam", ag: 19 },
    ]);
  
    function handlein(val) {
      // let temp=data;
      // temp.farhan=val;
      // console.log(temp.farhan);
      data.farhan = val;
      setdata({ ...data });
    }
  
    function handleinfr(valu) {
      // let t=data;
      // t.friend.ali=valu;
      // console.log(t.friend.ali);
  
      data.friend.ali = valu;
      setdata({ ...data, friend: { ...data.friend, valu } });
    }
  
    function handlearray(a) {
      dataarr[dataarr.length - 1].ag = a;
      setdataarr([...dataarr]);
    }

  return (
    <>
    <h2>B</h2>
    <C aler={aler} mes={mes}></C>
       <input onChange={(e) => handlein(e.target.value)}></input>
      <input onChange={(e) => handleinfr(e.target.value)}></input>
      <h5>{data.farhan}</h5>
      <h5>{data.friend.ali}</h5>


      <hr></hr>
      <input type="text" onChange={(e) => handlearray(e.target.value)}></input>
      {dataarr.map((item, index) => (
        <h4 key={index}>
          {item.nam}age:{item.ag}
        </h4>
      ))}
    </>

  )
}
