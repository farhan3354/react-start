import React, { useState } from "react";
import B from "./B";
import Valuesub from "./Context";

export default function A() {
  const [selec, setselec] = useState("English");

  function aler() {
    const mes = "Hello Farhan in the Props drilling A";

    alert(mes);
  }
  const mes = "Hello Farhan in the Props drilling A";
  return (
    <>
      <Valuesub.Provider value={selec}>
        <h2>A</h2>
        <select onChange={(e) => setselec(e.target.value)}>
          <option value={""}>select</option>
          <option value={"English"}>English</option>
          <option value={"Math"}>Math</option>
          <option value={"Physics"}>Physics</option>
        </select>
        <B aler={aler} mes={mes}></B>
      </Valuesub.Provider>
      <h2>A</h2>
    </>
  );
}
