import React from "react";
import Todo from "./Todo";

function Conditional(props) {
  function mes(text) {
    alert(text);
  }

  return (
    <>
      {console.log(props.arr)}
      {props.value ? "Hello Farhan" : "Register is flase"}
     <div>
       {props.arr.map((nam, index) => (
        <h3 key={index}> {nam}</h3>
      ))}
     </div>
     
      <button onClick={() => mes("hello")}>Hello</button>
      
      <Todo name="Farhan" value={true}></Todo>
      {/* <Todo name="Ali" value={true}></Todo>
      <Todo name="" value={false}></Todo> */}
    </>
  );
}

export default Conditional;
