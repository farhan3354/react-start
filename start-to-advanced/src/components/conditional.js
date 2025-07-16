import React from "react";

function Conditional(props) {
  function mes(text) {
    alert(text);
  }

  return (
    <>
      {console.log(props.arr)}
      {props.value ? "Hello Farhan" : "Register is flase"}
      {props.arr.map((nam, index) => (
        <h3> {nam}</h3>
      ))}
      <button onClick={() => mes("hello")}>Hello</button>
    </>
  );
}

export default Conditional;
