import React, { useContext } from "react";
import Valuesub from "./Context";

// export default function D({aler,mes}) {
export default function D() {
 

  const sub = useContext(Valuesub);
  return (
    <>
      <h2>D</h2>
      <p>{sub}</p>
    </>
  );
}

// import React from "react";

// export default function D({aler,mes}) {
//   return (
//     <>
//       <h2>D</h2>
//       <button onClick={aler}>Click Props drilling</button>
//         <p>{mes}</p>
//     </>
//   );
// }
