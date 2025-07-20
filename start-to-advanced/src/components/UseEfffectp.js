import { useState, useEffect } from "react";

export default function UseEfffectp() {
  const [count, setcount] = useState(0);
  const [timer, settimer] = useState(0);
  const [color, setcolor] = useState("green");

  function cou() {
    console.log("counter", count);
  }

  // useEffect(() => {
  //   cou();
  //   console.log("mounting Phase");
  // }, []);

  // updating phase

  useEffect(() => {
    cou();
    console.log("updating Phase");
  }, [count]);

  useEffect(() => {
    return () => {
      console.log("unmounting Phase");
    };
  }, [count]);

  useEffect(() => {
    const interval = setInterval(() => {
      settimer(new Date().toLocaleTimeString());
    }, 1000);

    return () => {
      clearInterval(interval);
      console.log("component unmount");
    };
  }, []);

  return (
    <>
      <div>UseEfffect</div>

      <button onClick={() => setcount(count + 1)}>counter + {count}</button>

      <select onChange={(e) => setcolor(e.target.value)}>
        <option value={"yellow"}>Yellow</option>
        <option value={"green"}>Green</option>
        <option value={"red"}>Red</option>
      </select>

      <h3
        style={{
          color: color,
          backgroundColor: "black",
          borderRadius: "10px",
          width: "130px",
          height: "27px",
          padding: "5px",
          paddingLeft: "15px",
        }}
      >
        {timer}
      </h3>
    </>
  );
}
