import React from "react";
import Conditional from "./components/conditional";

function App() {
  let register = false;
  let name = ["farhan", "bashir", "sam", "asif"];

  return (
    <div className="App">
      <Conditional value={register} arr={name} />

      
    </div>
  );
}

export default App;
