import React from "react";

export default function Lifting({ name }) {
  return (
    <>
      <div>Lifting up state</div>

      <h2>Name is coming from the parent {name}</h2>
    </>
  );
}
