import { useState } from "react";
import { sculptureList } from "./data";
import "./style.css";

function Todo(props) {
  const [index, setindex] = useState(0);
  const [showm, setshowm] = useState(false);
  const [fist, setfirst] = useState(" ");

  const users = [
    { id: 1, name: "Farhan", role: "Seller" },
    { id: 2, name: "Ali", role: "Customer" },
    { id: 3, name: "Zara", role: "Admin" },
  ];

  function handleindex() {
    if (index < 11) {
      setindex(index + 1);
    } else {
      setindex(index);
    }
  }

  function prev() {
    if (index > 0) {
      setindex(index - 1);
    } else {
      setindex(index);
    }
  }

  let datain = sculptureList[index];

  //     const mapedarr = users.map(person=>{
  //      return <>
  //         <li>
  //         <h3>{person.id}</h3>
  //         <h3>{person.name}</h3>
  //         <h3>{person.role}</h3>
  //         </li>
  //         </>
  // })

  /* <ul>
        {mapedarr}
    </ul>     */

  function handleshow() {
    setshowm(!showm);
  }

  function handleinput(e){
    setfirst(e.target.value);
  }

  return (
    <>
      {/* <button onClick={handleindex}>Next</button>
     <h4>{datain.name} by {datain.artist}</h4>
     <img src={datain.url} alt={datain.alt} />
     <p>{datain.description}</p>
     ({index + 1} of {sculptureList.length}) */}

      <div className="gallery-card">
        <div className="image-container">
          <img src={datain.url} alt={datain.alt} />
        </div>
        <div className="content">
          <h4>
            {datain.name} by {datain.artist}
          </h4>

          <button onClick={handleshow}>
            {showm ? "Hide" : "Show"} details
          </button>

          {showm && <p>{datain.description}</p>}

          <div className="navigation">
            <button onClick={prev}>Previous</button>
            <span>
              {index + 1} of {sculptureList.length}
            </span>
            <button onClick={handleindex}>Next</button>
          </div>
        </div>
      </div>

      <h4>
        {props.name === "Farhan" || props.value === true
          ? "HEllo"
          : "Good Bye from me"}
      </h4>

      <div>
        {users.map((user) => (
          <div key={user.id}>
            <h3>{user.name}</h3>
            <h3>{user.role}</h3>
          </div>
        ))}
      </div>

        <form onSubmit={(e)=>e.preventDefault()}>
        <input type="text" value={fist} onChange={handleinput}></input>
      <h1>Hi, {fist}</h1>

        </form>

    </>
  );
}

export default Todo;
