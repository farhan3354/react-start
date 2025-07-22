import React, { useState } from "react";
import Conditional from "./components/conditional";
import Button from "./components/Button";
import Product from "./components/pages/Product";
import A from "./components/A";
import { Route, Routes } from "react-router-dom";
import Home from "./components/pages/Home";
import About from "./components/pages/About";
import Subject from "./components/pages/Subject";
import Dep from "./components/pages/Dep";
import PageNot from "./components/pages/PageNot";
import Userlist from "./components/pages/Userlist";
import User from "./components/pages/User";
import Store from "./components/pages/Store";

function App() {
  const [hidecom, sethidecom] = useState(true);

  let register = false;
  let name = ["farhan", "bashir", "sam", "asif"];

  return (
    <div className="App">
      {/* <Button sethidecom={sethidecom} hidecom={hidecom}></Button> */}
      {/* {hidecom ? <Conditional value={register} arr={name} /> : null} */}

      <Routes>
        <Route path="/product" element={<Product></Product>}></Route>
        <Route path="/" element={<A></A>}></Route>
        <Route path="/home" element={<Home></Home>}></Route>

        <Route path="/about" element={<About></About>}>
          <Route path="subject" element={<Subject></Subject>}></Route>
          <Route path="dep" element={<Dep></Dep>}></Route>
        </Route>
        <Route path="/user" element={<Userlist></Userlist>}></Route>
        <Route path="/userdetail/:id" element={<User></User>}></Route>
        <Route path="/store" element={<Store></Store>}></Route>
        {/* <Route path="/*" element={<PageNot></PageNot>}></Route> */}
      </Routes>
    </div>
  );
}

export default App;
